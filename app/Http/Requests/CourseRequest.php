<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\HhMmSsFormat;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_title' => 'required|string|max:255',
            'course_video' => 'nullable|string|max:255',
            'course_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:9048',
            'level_id' => 'required|exists:levels,id',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'text' => 'nullable|string',

            'modules' => 'required|array|min:1',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.contents' => 'required|array|min:1',
            'modules.*.contents.*.type' => 'required|in:video,quiz',
            'modules.*.contents.*.title' => 'required|string|max:255',
            'modules.*.contents.*.source' => 'required|in:local,vimeo,youtube,cloud',
            'modules.*.contents.*.url' => 'required|string|max:500',
            'modules.*.contents.*.length' => [
                'nullable',
                new HhMmSsFormat
            ]
        ];
    }
}
