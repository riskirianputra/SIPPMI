<?php

namespace App\Http\Requests;

use App\RipTahapan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateRipTahapanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rip_tahapan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'tahun' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
