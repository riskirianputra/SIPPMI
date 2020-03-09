<?php

namespace App\Http\Requests;

use App\OutputSkema;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateOutputSkemaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('output_skema_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'output_id' => [
                'required',
                'integer',
            ],
            'skema_id'  => [
                'required',
                'integer',
            ],
            'field'     => [
                'required',
            ],
        ];
    }
}
