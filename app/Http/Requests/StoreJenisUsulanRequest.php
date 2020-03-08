<?php

namespace App\Http\Requests;

use App\JenisUsulan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreJenisUsulanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('jenis_usulan_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}
