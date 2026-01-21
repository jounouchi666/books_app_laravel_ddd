<?php

namespace App\Http\Requests;

use App\Application\Book\Query\ListBookQuery;
use Illuminate\Foundation\Http\FormRequest;

class BookSearchRequest extends FormRequest
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
            'user_id'     => ['nullable', 'integer', 'min:1'],
            'category_id' => ['nullable', 'integer', 'min:1'],
            'sort'        => ['nullable', 'string', 'in:title,user_id,category_id,created_at'],
            'direction'   => ['nullable', 'in:desc,asc'],
            'trash_type'  => ['nullable', 'string', 'in:active,with_trashed,only_trashed']
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
            'user_id.integer'     => '正規のユーザーを入力してください',
            'category_id.integer' => '正規のカテゴリーを入力してください',
            'sort.in'             => 'ソート項目が有効ではありません',
            'direction.in'        => '昇順（desc）または降順（asc）で入力してください',
            'trash_type.in'       => '削除タイプが有効ではありません',
        ];
    }
    
    /**
     * クエリオブジェクトを生成
     *
     * @return ListBookQuery
     */
    public function buildQuery(): ListBookQuery
    {
        return new ListBookQuery(
            $this->integer('user_id'),
            $this->integer('category_id'),
            $this->input('sort'),
            $this->input('direction'),
            $this->input('trash_type'),
            $this->integer('page', 1),
            $this->integer('per_page', 50)
        );
    }
}
