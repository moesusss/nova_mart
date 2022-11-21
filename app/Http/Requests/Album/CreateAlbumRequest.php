<?php

namespace App\Http\Requests\Album;

use Illuminate\Foundation\Http\FormRequest;

class CreateAlbumRequest extends FormRequest
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
        return [
            'title' => 'required|string',
            'mm_title' => 'nullable|string',
            'artist_id' => 'required|integer|exists:artists,id',
            'content_provider_id' => 'required|integer|exists:content_providers,id',
            'genre_id' => 'required|integer|exists:genres,id',
            'ingestion_status' => 'required|string',
            'label' => 'nullable|string',
            'upc' => 'nullable|string',
            'image' => 'required|string',
            'released_date' => 'required|date_format:Y-m-d',
        ];
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'artist_id.required' => 'Artist field is required',
            'content_provider_id.required' => 'Content Provider field is required',
            'genre_id.required' => 'Genre field is required',
        ];
    }
}
