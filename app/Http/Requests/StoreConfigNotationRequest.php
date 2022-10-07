<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConfigNotationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Здесь можно сделать валидацию прав доступа (см. документацию Laravel)
        //                               https://laravel.com/docs/5.8/validation
        // Если метод возвращает false - браузер получит ошибку 403
        return true;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // Сюда можно написать свои сообщения об ошибках
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            // Здесь можно создать алиасы для названий полей,
            // которые будут подставлены в стандартные сообщения об ошибках
            'name' => 'название',
            'file' => 'изображение',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:1|max:128',
            'file' => 'nullable|image|min:1|max:5000|',
        ];
    }
}
