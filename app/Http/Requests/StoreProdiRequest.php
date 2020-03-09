<?php

namespace App\Http\Requests;

use App\Prodi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreProdiRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('prodi_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'nama' => [
                'required',
            ],
        ];
    }
}
