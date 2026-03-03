<?php

namespace App\Http\Requests;

use App\Application\Book\DTO\SaveBookDto;
use App\Domain\Book\ValueObject\BookReadingStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class BookRequest extends FormRequest
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
            'title'          => ['required', 'string', 'min:2', 'max:100'],
            'category_id'    => ['nullable', 'integer', 'min:1', Rule::exists('categories', 'id')->whereNull('deleted_at')],
            'reading_status' => ['nullable', new Enum(BookReadingStatus::class)]
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
            'title.min'           => 'タイトルは2文字以上で入力してください',
            'title.max'           => 'タイトルは100文字以内で入力してください',
            'category_id.integer' => '正規のカテゴリーを入力してください',
            'category_id.exists'  => '選択したカテゴリーは削除されています',
            'reading_status.enum' => '読書状況が有効ではありません',
        ];
    }

    /**
     * 保存用DTOを生成
     *
     * @return SaveBookDto
     */
    public function buildSaveData(): SaveBookDto
    {
        $data = $this->validated();

        return new SaveBookDto(
            $data['title'],
            $data['category_id'],
            BookReadingStatus::tryFrom($data['reading_status'] ?? '')
        );
    }
}
