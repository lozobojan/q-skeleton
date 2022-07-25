<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            "authorId" => ['required', 'integer'],
            "title" => ['required', 'min:2'],
            "releaseDate" => ['required'],
            "format" => ['required'],
            "isbn" => ['required'],
            "numberOfPages" => ['required'],
            "description" => ['required'],
        ];
    }
}
