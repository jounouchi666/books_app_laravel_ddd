<?php

namespace App\Http\Requests;

use App\Application\Category\Query\ListCategoryQuery;
use App\Application\Shared\Enum\SortDirection;
use App\Application\Shared\Enum\TrashType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CategorySearchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sort'       => ['nullable', 'string', 'in:title,created_at'],
            'direction'  => ['nullable', new Enum(SortDirection::class)],
            'trash_type' => ['nullable', new Enum(TrashType::class)]
        ];
    }

    /**
     * error messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'sort.in'         => 'ソート項目が有効ではありません',
            'direction.enum'  => '昇順（desc）または降順（asc）で入力してください',
            'trash_type.enum' => '削除タイプが有効ではありません',
        ];
    }

    /**
     * クエリオブジェクトを生成
     *
     * @return ListCategoryQuery
     */
    public function buildQuery(): ListCategoryQuery
    {
        return new ListCategoryQuery(
            $this->string('sort') ?: null,
            $this->enum('direction', SortDirection::class) ?: null,
            $this->enum('trash_type', TrashType::class) ?: null,
            $this->integer('page', 1),
            $this->integer('per_page', 15)
        );
    }
}
