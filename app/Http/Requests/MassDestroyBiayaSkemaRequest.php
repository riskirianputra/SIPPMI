<?php

namespace App\Http\Requests;

use App\BiayaSkema;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyBiayaSkemaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('biaya_skema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:biaya_skemas,id',
        ];
    }
}
