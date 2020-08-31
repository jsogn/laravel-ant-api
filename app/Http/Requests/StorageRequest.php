<?php

namespace App\Http\Requests;

class StorageRequest extends BaseFromRequest
{
    public function rules()
    {
        return [
            'image' => 'filled|image|max:2024',
            'video' => 'filled|mimes:mp3,mp4|max:102400',
            'topic' => 'required|string|max:10',
        ];
    }
}
