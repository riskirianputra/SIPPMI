<?php

namespace App\Http\Requests;

use App\PenelitianReviewer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePenelitianReviewerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('penelitian_reviewer_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'tahapan_review_id' => [
                'required',
                'integer',
            ],
            'reviewer_id'       => [
                'required',
                'integer',
            ],
        ];
    }
}
