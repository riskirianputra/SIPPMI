<?php

namespace App\Http\Requests;

use App\RipTopik;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRipTopikRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rip_topik_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rip_topiks,id',
        ];
    }
}
