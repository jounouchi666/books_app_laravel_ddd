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
            'user_id'        => ['nullable', 'integer', 'min:1'],
            'all_users'      => ['nullable', 'boolean'],
            'category_id'    => ['nullable', 'integer', 'min:1'],
            'reading_status' => ['nullable', 'string', 'in:all,unread,reading,completed'],
            'sort'           => ['nullable', 'string', 'in:title,user_id,category_id,created_at'],
            'direction'      => ['nullable', 'in:desc,asc'],
            'trash_type'     => ['nullable', 'string', 'in:active,with_trashed,only_trashed']
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
            'all_users.boolean'   => '作成者の指定が不正です',
            'category_id.integer' => '正規のカテゴリーを入力してください',
            'reading_status.in'   => '読書状況が有効ではありません',
            'sort.in'             => 'ソート項目が有効ではありません',
            'direction.in'        => '降順（desc）または昇順（asc）で入力してください',
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
            $this->filled('user_id') ? (int)$this->input('user_id') : null,
            $this->filled('all_users') ? $this->boolean('all_users') : false,
            $this->filled('category_id') ? (int)$this->input('category_id') : null,
            $this->filled('reading_status') ? (string)$this->input('reading_status') : null,
            $this->input('sort'),
            $this->input('direction'),
            $this->filled('trash_type') ? (string)$this->input('trash_type') : null,
            $this->integer('page', 1),
            $this->integer('per_page', 15)
        );
    }
}
