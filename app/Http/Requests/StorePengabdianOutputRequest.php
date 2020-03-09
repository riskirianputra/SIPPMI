<?php

namespace App\Http\Requests;

use App\PengabdianOutput;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StorePengabdianOutputRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pengabdian_output_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'output_skema_id' => [
                'required',
                'integer',
            ],
            'pengabdian_id'   => [
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
