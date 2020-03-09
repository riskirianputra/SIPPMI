<?php

namespace App\Http\Requests;

use App\RipTahapan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRipTahapanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rip_tahapan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rip_tahapans,id',
        ];
    }
}
