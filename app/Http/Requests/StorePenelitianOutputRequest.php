<?php

namespace App\Http\Requests;

use App\PenelitianOutput;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StorePenelitianOutputRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('penelitian_output_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'output_skema_id' => [
                'required',
                'integer',
            ],
            'penelitian_id'   => [
                'required',
                'integer',
            ],
            'filename'        => [
                'required',
            ],
            'tanggal_upload'  => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
        ];
    }
}
