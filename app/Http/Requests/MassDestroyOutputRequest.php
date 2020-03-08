<?php

namespace App\Http\Requests;

use App\Output;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyOutputRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('output_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:outputs,id',
        ];
    }
}
