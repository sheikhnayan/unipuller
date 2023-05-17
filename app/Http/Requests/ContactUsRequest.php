<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class ContactUsRequest extends FormRequest
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
    public function rules(Request $request, $gs)
    {

        if ($gs->is_capcha == 1) {
            $rules = [
                'g-recaptcha-response' => 'required',
                'full_name' => 'required|max:255',
                'phone_no' => 'required|numeric',
            ];
        }
        $rules = [
            'full_name' => 'required|max:255',
            'phone_no' => 'required|numeric',
        ];

        return $rules;
    }
    public function messages()
    {
        return [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'password.confirmed' => 'Your password confirmation does not match.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'status' => 'error',
            'message' => $validator->errors()->first(),
        ];
        // Add validation error messages to the response
        $response['errors'] = $validator->getMessageBag()->toArray();
        throw new HttpResponseException(response()->json($response, JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
