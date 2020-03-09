<?php

namespace App\Http\Requests;

use App\Pengabdian;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPengabdianRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pengabdian_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pengabdians,id',
        ];
    }
}
