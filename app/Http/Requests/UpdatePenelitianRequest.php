<?php

namespace App\Http\Requests;

use App\Penelitian;
use App\RefSkema;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdatePenelitianRequest extends FormRequest
{
    public function authorize()
    {
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
            'file_cv'  => ['sometimes','required', 'mimes:pdf'],
            'file_pengesahan' => ['sometimes','required' , 'mimes:pdf'],
            'file_proposal' => ['sometimes','required', 'mimes:pdf']
        ];
    }
}
