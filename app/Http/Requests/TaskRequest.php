<?php

namespace App\Http\Requests;

use App\Rules\NoSpecialChars;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:100' , new NoSpecialChars],
            'details' => 'required|max:250',
            'status' => 'required',
            'due_date' => 'required',    
        ];
    }

    public function attributes()
    {
        return [
            'details' => 'Description',
            'title' => 'Title',
            'due_date' => 'Due date'
        ];
    }
    public function messages()
    {
       return [

        'title.max' => 'Maximum character will not be greather than 25!'

       ];

    }


    protected function prepareForValidation()
    {
        $this->merge([
            'title' => strtoupper($this->title)
        ]);
    }
    protected $stopOnFirstFailure = true;
}
