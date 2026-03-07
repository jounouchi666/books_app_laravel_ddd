<?php

namespace App\Http\Requests;

use App\Application\Book\DTO\SaveBookReadingStatusDto;
use App\Domain\Book\ValueObject\BookReadingStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ChangeBookReadingStatusRequest extends FormRequest
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
            'reading_status' => ['required', new Enum(BookReadingStatus::class)]
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
            'reading_status.enum' => '読書状況が有効ではありません'
        ];
    }

    protected function prepareForValidation(): void
    {
        // エラーバッグにID付きの名称を付与
        $id = $this->route('id');

        if ($id) {
            $this->errorBag = 'update_status_' . $id;
        }
    }

    /**
     * 保存用DTOを生成
     *
     * @return SaveBookReadingStatusDto
     */
    public function buildSaveData(): SaveBookReadingStatusDto
    {
        $data = $this->validated();

        return new SaveBookReadingStatusDto(
            BookReadingStatus::from($data['reading_status'])
        );
    }
}
