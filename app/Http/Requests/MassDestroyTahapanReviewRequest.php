<?php

namespace App\Http\Requests;

use App\TahapanReview;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTahapanReviewRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tahapan_review_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tahapan_reviews,id',
        ];
    }
}
