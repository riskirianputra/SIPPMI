<?php

namespace App\Http\Requests;

use App\Usulan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateUsulanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('usulan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}
