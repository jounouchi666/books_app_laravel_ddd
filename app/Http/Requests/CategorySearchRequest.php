<?php

namespace App\Http\Requests;

use App\Application\Category\Query\ListCategoryQuery;
use Illuminate\Foundation\Http\FormRequest;

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
            'sort'      => ['nullable', 'string', 'in:title,user_id,category_id,created_at'],
            'direction' => ['nullable', 'in:desc,asc']
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
            'sort.in'       => 'ソート項目が有効ではありません',
            'direction.in'  => '昇順（desc）または降順（asc）で入力してください'
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
            $this->input('sort'),
            $this->input('direction')
        );
    }
}
