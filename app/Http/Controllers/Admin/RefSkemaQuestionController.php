<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\RefSkema;
use App\RefSkemaQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class RefSkemaQuestionController extends Controller
{

    public function create(RefSkema $refSkema)
    {
        abort_if(Gate::denies('ref_skema_manage'), Response::HTTP_FORBIDDEN, 403);

        return view('admins.ref_skemas.questions.create', compact('refSkema'));
    }

    public function store(Request $request, RefSkema $refSkema)
    {
        abort_if(Gate::denies('ref_skema_manage'), Response::HTTP_FORBIDDEN, 403);

        $request->validate([
            'pertanyaan' => 'required',
            'bobot' => 'required',
            'tipe_pertanyaan' => 'required'
        ]);

        if(RefSkemaQuestion::create($request->all())){
            notify('success', 'Berhasil tambah data');
        }

        return redirect()->route('admin.ref-skemas.questions.create', [$refSkema]);
    }

    public function edit(RefSkema $refSkema, RefSkemaQuestion $question)
    {
        abort_if(Gate::denies('ref_skema_manage'), Response::HTTP_FORBIDDEN, 403);

        return view('admins.ref_skemas.questions.edit', compact('refSkema', 'question'));
    }

    public function update(Request $request, RefSkema $refSkema, RefSkemaQuestion $question){
        abort_if(Gate::denies('ref_skema_manage'), Response::HTTP_FORBIDDEN, 403);

        $request->validate([
            'pertanyaan' => 'required',
            'bobot' => 'required',
            'tipe_pertanyaan' => 'required'
        ]);

        if($question->update($request->all())){
            notify('success', 'Berhasil update data');
        }
        return redirect()->route('admin.ref-skemas.questions.edit', [$refSkema->id, $question->id]);
    }

    public function destroy(Request $request, RefSkema $refSkema, RefSkemaQuestion $question){
        abort_if(Gate::denies('ref_skema_manage'), Response::HTTP_FORBIDDEN, 403);

        if($question->delete()){
            notify('success', 'Berhasil menghapus data pertanyaan');
        }
        return redirect()->route('admin.ref-skemas.show', [$refSkema->id]);
    }
}
