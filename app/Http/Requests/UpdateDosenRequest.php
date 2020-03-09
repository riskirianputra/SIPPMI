<?php

namespace App\Http\Requests;

use App\Dosen;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateDosenRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('dosen_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'nama'          => [
                'required',
            ],
            'email'         => [
                'required',
                'unique:dosens,email,' . request()->route('dosen')->id,
            ],
            'tanggal_lahir' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
