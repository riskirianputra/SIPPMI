<?php

namespace App\Http\Requests;

use App\PengabdianAnggotum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StorePengabdianAnggotumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pengabdian_anggotum_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}
