<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:([a-zA-Z\-. ]+)|max:255',
            'image' => 'required_without:old_image|nullable|file|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'styles' => 'required',
        ];
    }
}
