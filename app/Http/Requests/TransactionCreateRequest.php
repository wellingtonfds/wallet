<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class TransactionCreateRequest extends FormRequest
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
        $request = $this->request;
        return [
            'payer'=>[
                'required',
                'exists:users,id',
                function ($attribute, $value, $fail) use ($request) {
                    $user = User::find($value);
                    if($user->type === 'business'){
                        $fail("the $attribute needs to be a personal account");
                    }

                    if($request->get('value') > $user->balance){
                        $fail("insufficient funds");
                    }
                }
            ],
            'payee'=>'required|exists:users,id',
            'value'=>'required|regex:/^\d*(\.\d{1,2})?$/'
        ];
    }

}
