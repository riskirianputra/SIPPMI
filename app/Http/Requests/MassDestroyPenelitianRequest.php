<?php

namespace App\Http\Requests;

use App\Penelitian;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyPenelitianRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('penelitian_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:penelitians,id',
        ];
    }
}
