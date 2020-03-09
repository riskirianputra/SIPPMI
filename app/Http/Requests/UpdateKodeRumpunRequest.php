<?php

namespace App\Http\Requests;

use App\KodeRumpun;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateKodeRumpunRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('kode_rumpun_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}
