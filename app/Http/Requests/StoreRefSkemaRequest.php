<?php

namespace App\Http\Requests;

use App\RefSkema;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreRefSkemaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('ref_skema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'jangka_waktu' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
