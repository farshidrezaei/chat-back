<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed dontFlash
 */
class RegisterRequest extends FormRequest
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
            'name' => [ 'required', 'string', 'max:255' ],
            'email' => [ 'required', 'string', 'email', 'max:255', 'unique:users' ],
            'password' => [ 'required', 'string', 'min:8' ],
        ];
    }

    public function response( array $errors )
    {
        if ( $this->ajax() || $this->wantsJson() ) {
            return response( [
                'result' => 'error',
                'message' => 'خطا در اعتبارسنجی اطلاعات ورودی',
                'data' => $errors
            ], 422 );
        }
        return $this->redirector->back()
            ->withInput( $this->except( $this->dontFlash ) )
            ->withErrors( $errors, $this->errorBag );
    }


}
