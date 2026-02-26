<?php

namespace App\Http\Requests;

use App\Application\Category\DTO\SaveCategoryDto;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'title' => ['required', 'string', 'min:2', 'max:100']
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
            'title.min' => 'タイトルは2文字以上で入力してください',
            'title.max' => 'タイトルは100文字以内で入力してください'
        ];
    }

    /**
     * 保存用DTOを生成
     *
     * @return SaveCategoryDto
     */
    public function buildSaveData(): SaveCategoryDto
    {
        $data = $this->validated();

        return new SaveCategoryDto(
            $data['title']
        );
    }
}
