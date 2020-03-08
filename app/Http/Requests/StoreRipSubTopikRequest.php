<?php

namespace App\Http\Requests;

use App\RipSubTopik;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRipSubTopikRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rip_sub_topik_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}
