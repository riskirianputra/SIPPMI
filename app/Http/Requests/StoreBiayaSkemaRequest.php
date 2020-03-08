<?php

namespace App\Http\Requests;

use App\BiayaSkema;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreBiayaSkemaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('biaya_skema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'persen_max' => [
                'max:100',
            ],
            'persen_min' => [
                'max:100',
            ],
        ];
    }
}
