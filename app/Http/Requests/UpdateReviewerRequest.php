<?php

namespace App\Http\Requests;

use App\Reviewer;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateReviewerRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('reviewer_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'status' => [
                'required',
            ],
        ];
    }
}
