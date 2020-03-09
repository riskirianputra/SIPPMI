<?php

namespace App\Http\Requests;

use App\Fakultum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFakultumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('fakultum_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:fakultas,id',
        ];
    }
}
