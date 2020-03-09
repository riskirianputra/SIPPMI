<?php

namespace App\Http\Requests;

use App\PengabdianBiaya;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPengabdianBiayaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pengabdian_biaya_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:pengabdian_biayas,id',
        ];
    }
}
