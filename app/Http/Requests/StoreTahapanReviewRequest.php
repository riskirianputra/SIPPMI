<?php

namespace App\Http\Requests;

use App\TahapanReview;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreTahapanReviewRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tahapan_review_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'nama'            => [
                'required',
            ],
            'jumlah_reviewer' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'mulai'           => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'selesai'         => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
