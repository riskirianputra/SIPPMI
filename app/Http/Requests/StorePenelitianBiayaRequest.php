<?php

namespace App\Http\Requests;

use App\PenelitianBiaya;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StorePenelitianBiayaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('penelitian_biaya_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'jumlah'             => [
                'required',
            ],
            'satuan'             => [
                'required',
            ],
            'harga_satuan'       => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'harga_satuan_final' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
