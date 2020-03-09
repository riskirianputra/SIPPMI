<?php

namespace App\Http\Requests;

use App\Staff;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreStaffRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('staff_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
                'unique:staff',
            ],
            'tanggal_lahir' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
