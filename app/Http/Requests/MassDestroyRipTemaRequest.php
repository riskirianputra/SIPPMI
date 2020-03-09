<?php

namespace App\Http\Requests;

use App\RipTema;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRipTemaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rip_tema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rip_temas,id',
        ];
    }
}
