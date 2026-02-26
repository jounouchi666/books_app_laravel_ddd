<?php

namespace App\Http\Requests;

use App\Application\Book\Query\ListBookQuery;
use App\Application\Shared\Enum\SortDirection;
use App\Application\Shared\Enum\TrashType;
use App\Domain\Book\ValueObject\BookReadingStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

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
            'reading_status' => ['nullable', new Enum(BookReadingStatus::class)],
            'sort'           => ['nullable', 'string', 'in:title,user_id,category_id,created_at'],
            'direction'      => ['nullable', new Enum(SortDirection::class)],
            'trash_type'     => ['nullable', new Enum(TrashType::class)]
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
            'reading_status.enum' => '読書状況が有効ではありません',
            'sort.in'             => 'ソート項目が有効ではありません',
            'direction.enum'      => '降順（desc）または昇順（asc）で入力してください',
            'trash_type.enum'     => '削除タイプが有効ではありません',
        ];
    }

    protected function prepareForValidation(): void
    {
        // reading_statusのallをnullに変換
        if ($this->reading_status === 'all') {
            $this->merge([
                'reading_status' => null,
            ]);
        }
    }
    
    /**
     * クエリオブジェクトを生成
     *
     * @return ListBookQuery
     */
    public function buildQuery(): ListBookQuery
    {
        return new ListBookQuery(
            $this->integer('user_id') ?: null,
            $this->boolean('all_users') ?: false,
            $this->integer('category_id') ?: null,
            $this->enum('reading_status', BookReadingStatus::class) ?: null,
            $this->string('sort') ?: null,
            $this->enum('direction', SortDirection::class) ?: null,
            $this->enum('trash_type', TrashType::class) ?: null,
            $this->integer('page', 1),
            $this->integer('per_page', 15)
        );
    }
}
