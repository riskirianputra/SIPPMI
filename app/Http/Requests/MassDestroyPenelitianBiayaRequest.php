<?php

namespace App\Http\Requests;

use App\PenelitianBiaya;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPenelitianBiayaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('penelitian_biaya_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:penelitian_biayas,id',
        ];
    }
}
