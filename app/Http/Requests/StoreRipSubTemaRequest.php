<?php

namespace App\Http\Requests;

use App\RipSubTema;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRipSubTemaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rip_sub_tema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}
