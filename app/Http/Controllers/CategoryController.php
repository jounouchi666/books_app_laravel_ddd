<?php

namespace App\Http\Controllers;

use App\Application\Category\DTO\CategoryFormDto;
use App\Application\Category\UseCase\CreateCategoryUseCase;
use App\Application\Category\UseCase\DeleteCategoryUseCase;
use App\Application\Category\UseCase\EditCategoryUseCase;
use App\Application\Category\UseCase\ListCategoryUseCase;
use App\Application\Category\UseCase\UpdateCategoryUseCase;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategorySearchRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct(
        private readonly ListCategoryUseCase $listCategoryUseCase,
        private readonly EditCategoryUseCase $editCategoryUseCase,
        private readonly CreateCategoryUseCase $createCategoryUseCase,
        private readonly UpdateCategoryUseCase $updateCategoryUseCase,
        private readonly DeleteCategoryUseCase $deleteCategoryUseCase
    ) {}
    
    /**
     * list
     *
     * @param  CategorySearchRequest $request
     * @return View
     */
    public function list(CategorySearchRequest $request): View
    {
        $categories = $this->listCategoryUseCase->execute(
            $request->buildQuery()
        );
        return view('admin.categories.list', compact('categories'));
    }
    
    /**
     * create
     *
     * @param  int $id
     * @return View
     */
    public function create(): View
    {
        return view('admin.categories.edit', [
            'category' => CategoryFormDto::empty(),
            'mode'     => 'edit'
        ]);
    }

    /**
     * edit
     *
     * @param  int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $category = $this->editCategoryUseCase->execute($id);
        
        return view('admin.categories.edit', [
            'category' => $category,
            'mode'     => 'edit'
        ]);
    }
    
    /**
     * store
     *
     * @param  CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->createCategoryUseCase->execute(
            $data['title']
        );
        
        return redirect()->route('categories.list')->with('success', '登録しました');
    }
    
    /**
     * update
     *
     * @param  CategoryRequest $request
     * @param  int $id
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        $this->updateCategoryUseCase->execute(
            $id,
            $data['title']
        );

        return redirect()->route('categories.list')->with('success', '更新しました');
    }
    
    /**
     * delete
     *
     * @param  int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->deleteCategoryUseCase->execute($id);

        return redirect()->route('categories.list')->with('success', '削除しました');
    }
}
