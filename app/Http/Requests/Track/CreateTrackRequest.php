<?php

namespace App\Http\Requests\Track;

use Illuminate\Foundation\Http\FormRequest;

class CreateTrackRequest extends FormRequest
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
            // 'content_provider_id' => 'required|integer|exists:content_providers,id',
            'genre_id' => 'required|integer|exists:genres,id',
            'language' => 'required|string',
            'duration' => 'required|numeric',
            'isrc' => 'required|string',
            'audio' => 'required|string',
            'featuring_artist_id' => 'nullable',
        ];
    }
}
