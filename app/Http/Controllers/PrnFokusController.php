<?php

namespace App\Http\Controllers;

use App\Http\Requests\MassDestroyPrnFokusRequest;
use App\Http\Requests\StorePrnFokusRequest;
use App\Http\Requests\UpdatePrnFokusRequest;
use App\PrnFokus;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PrnFokusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('prn_fokus_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prnFokus = PrnFokus::all();

        return view('prnFokus.index', compact('prnFokus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('prn_fokus_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('prnFokus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrnFokusRequest $request)
    {
        $prnFokus = PrnFokus::create($request->all());

        return redirect()->route('prn-fokus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PrnFokus  $prnFokus
     * @return \Illuminate\Http\Response
     */
    public function show(PrnFokus $prnFokus)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PrnFokus  $prnFokus
     * @return \Illuminate\Http\Response
     */
    public function edit(PrnFokus $prnFokus)
    {

        abort_if(Gate::denies('prn_fokus_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('prnFokus.edit', compact('prnFokus'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PrnFokus  $prnFokus
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePrnFokusRequest $request, PrnFokus $prnFokus)
    {
        $prnFokus->update($request->all());

        return redirect()->route('prn-fokus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PrnFokus  $prnFokus
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrnFokus $prnFokus)
    {
        abort_if(Gate::denies('prn_fokus_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prnFokus->delete();

        return back();
    }

    public function massDestroy(MassDestroyPrnFokusRequest $request)
    {
        PrnFokus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
