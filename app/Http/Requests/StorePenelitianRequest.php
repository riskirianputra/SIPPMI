<?php

namespace App\Http\Requests;

use App\Penelitian;
use App\RefSkema;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StorePenelitianRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('penelitian_user_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        $skema = RefSkema::findOrFail(request()->get('skema_id'));
        return [
            'judul'    => ['required',],
//            'prodi_id' => ['required','integer',],
            'fokus_id' => ['required','integer',],
            'skema_id' => ['required'],
            'biaya'    => ['required','integer','min:'.$skema->biaya_minimal,'max:'.$skema->biaya_maksimal],
            'file_cv'  => ['required', 'mimes:pdf'],
            'file_pengesahan' => ['required' , 'mimes:pdf'],
            'file_proposal' => ['required', 'mimes:pdf']
        ];
    }
//, 'size:10MB'
}
