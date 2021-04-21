<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $videoMimes = "mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi";

        $rules  = [
            'title' => 'required|min:6|max:120',
            'description' => 'required|min:20|max:5000',
        ];

        if (request()->method() !== 'PUT') {
            $rules['video'] = 'required|max:10000|' . $videoMimes;
        } else {
            $rules['video'] = 'max:10000|' . $videoMimes;
        }

        return $rules;
    }
}
