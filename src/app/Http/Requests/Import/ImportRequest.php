<?php

namespace App\Http\Requests\Import;

use Illuminate\Foundation\Http\FormRequest;

class ImportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'import_file' => 'required|file|mimes:xlsx',
        ];
    }

    public function messages(): array
    {
        return [
            'import_file.required' => 'Обязательное поле',
            'import_file.mimes' => 'Выберите файл формата .xlsx',
        ];
    }
}
