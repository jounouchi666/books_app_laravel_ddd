<?php

namespace App\Http\Controllers;

use App\Application\Book\DTO\BookFormDto;
use App\Application\Book\UseCase\CreateBookUseCase;
use App\Application\Book\UseCase\DeleteBookUseCase;
use App\Application\Book\UseCase\EditBookUseCase;
use App\Application\Book\UseCase\ForceDeleteBookUseCase;
use App\Application\Book\UseCase\ListBookUseCase;
use App\Application\Book\UseCase\RestoreBookUseCase;
use App\Application\Book\UseCase\ShowBookUseCase;
use App\Application\Book\UseCase\UpdateBookUseCase;
use App\Application\Category\UseCase\ListSelectableCategoryUseCase;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookSearchRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class BookController extends Controller
{
    public function __construct(
        private readonly ListBookUseCase $listBookUseCase,
        private readonly ShowBookUseCase $showBookUseCase,
        private readonly EditBookUseCase $editBookUseCase,
        private readonly CreateBookUseCase $createBookUseCase,
        private readonly UpdateBookUseCase $updateBookUseCase,
        private readonly DeleteBookUseCase $deleteBookUseCase,
        private readonly RestoreBookUseCase $restoreBookUseCase,
        private readonly ForceDeleteBookUseCase $forceDeleteBookUseCase,
        private readonly ListSelectableCategoryUseCase $listSelectableCategoryUseCase
    ) {}
    
    /**
     * index
     *
     * @param  BookSearchRequest $request
     * @return View
     */
    public function index(BookSearchRequest $request): View
    {
        $books = $this->listBookUseCase->execute(
            $request->buildQuery()
        );
        return view('books.index', compact('books'));
    }
    
    /**
     * show
     *
     * @param  int $id
     * @return View
     */
    public function show(int $id): View
    {
        $book = $this->showBookUseCase->execute($id);

        return view('books.show', compact('book'));
    }
    
    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        $categories = $this->listSelectableCategoryUseCase->execute();

        return view('books.edit', [
            'book' => BookFormDto::empty(),
            'categories' => $categories,
            'mode' => 'create',
            'title' => '書籍新規登録'
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
        $book = $this->editBookUseCase->execute($id);
        $categories = $this->listSelectableCategoryUseCase->execute();

        return view('books.edit', [
            'book' => $book,
            'categories' => $categories,
            'mode' => 'edit',
            'title' => '書籍編集'
        ]);
    }
    
    /**
     * store
     *
     * @param  BookRequest $request
     * @return RedirectResponse
     */
    public function store(BookRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->createBookUseCase->execute(
            $data['title'],
            Auth::id(),
            $data['category_id']
        );

        return redirect()->route('books.index')->with('success', '登録しました');
    }
    
    /**
     * update
     *
     * @param  BookRequest $request
     * @param  int $id
     * @return RedirectResponse
     */
    public function update(BookRequest $request, int $id): RedirectResponse
    {
        $data = $request->validated();

        $newBook = $this->updateBookUseCase->execute(
            $id,
            $data['title'],
            Auth::id(),
            $data['category_id']
        );

        return redirect()
            ->route('books.show', ['id' => $newBook->id()->value()])
            ->with('success', '登録しました');
    }
    
    /**
     * delete
     *
     * @param  int $id
     * @return RedirectResponse
     */
    public function delete(BookSearchRequest $request, int $id): RedirectResponse
    {
        $response = $this->deleteBookUseCase->execute(
            $id,
            $request->buildQuery());

        return redirect()
            ->route(
                'books.index',
                $response->bookUIQuery->toQueryArray()
            )
            ->with('success', $response->message);
    }

    /**
     * restore
     *
     * @param  int $id
     * @return RedirectResponse
     */
    public function restore(BookSearchRequest $request, int $id): RedirectResponse
    {
        $response = $this->restoreBookUseCase->execute(
            $id,
            $request->buildQuery());

        return redirect()
            ->route(
                'books.index',
                $response->bookUIQuery->toQueryArray()
            )
            ->with('success', $response->message);
    }

    /**
     * force delete
     *
     * @param  int $id
     * @return RedirectResponse
     */
    public function forceDelete(BookSearchRequest $request, int $id): RedirectResponse
    {
        $response = $this->forceDeleteBookUseCase->execute(
            $id,
            $request->buildQuery());

        return redirect()
            ->route(
                'books.index',
                $response->bookUIQuery->toQueryArray()
            )
            ->with('success', $response->message);
    }
}
