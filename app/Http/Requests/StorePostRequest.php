<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // $postId = isset($post) ? $post->id : null;

        return [
            //
            'postTitle' => [
                'postTitle' => ['required', 'min:3', 'unique:posts,title,except,id'],
                'postDescription' => ['required', 'min:5'],
            ],
            'postDescription' => ['required', 'min:5'],
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'A title is required',
            'title.min' => 'A title can\'t be less than 3 char',
            'body.required' => 'A message is required',
        ];
    }
}
