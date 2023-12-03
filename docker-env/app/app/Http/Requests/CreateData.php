<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateData extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'display_title'=>'required|max:100',
            'title'=>'required|max:50',
            'memo'=>'max:300',
            'main_image'=>'required',
            'display_title'=>'required',
            'tag_id'=>'required',
            'time'=>'required|integer|min:1',
            'serve'=>'required|integer|min:1',
        ];
    }
}
