<?php

namespace App\Http\Requests;

use App\PenelitianAnggotum;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StorePenelitianAnggotumRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('penelitian_anggotum_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
        ];
    }
}
