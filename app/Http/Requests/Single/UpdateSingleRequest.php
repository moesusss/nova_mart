<?php

namespace App\Http\Requests\Single;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSingleRequest extends FormRequest
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
            'content_provider_id' => 'required|integer|exists:content_providers,id',
            'ingestion_status' => 'required|string',
            'label' => 'nullable|string',
            'upc' => 'required|string',
            'image' => 'required|string',
            'released_date' => 'required|date_format:Y-m-d',

            'title' => 'required|string',
            'mm_title' => 'nullable|string',
            'artist_id' => 'required|integer|exists:artists,id',
            'genre_id' => 'required|integer|exists:genres,id',
            'language' => 'required|string',
            'duration' => 'required|numeric',
            'isrc' => 'required|string',
            'audio' => 'required|string',
        ];
    }
}
