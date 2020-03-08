<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class StorePrnFokusRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('prn_fokus_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'nama'      => [
                'required',
            ],
        ];
    }
}
