<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePenelitianBiayaRequest;
use App\Http\Requests\UpdatePenelitianBiayaRequest;
use App\Http\Resources\Admin\PenelitianBiayaResource;
use App\PenelitianBiaya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PenelitianBiayaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('penelitian_biaya_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenelitianBiayaResource(PenelitianBiaya::with(['biaya_skema', 'penelitian'])->get());
    }

    public function store(StorePenelitianBiayaRequest $request)
    {
        $penelitianBiaya = PenelitianBiaya::create($request->all());

        return (new PenelitianBiayaResource($penelitianBiaya))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(PenelitianBiaya $penelitianBiaya)
    {
        abort_if(Gate::denies('penelitian_biaya_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PenelitianBiayaResource($penelitianBiaya->load(['biaya_skema', 'penelitian']));
    }

    public function update(UpdatePenelitianBiayaRequest $request, PenelitianBiaya $penelitianBiaya)
    {
        $penelitianBiaya->update($request->all());

        return (new PenelitianBiayaResource($penelitianBiaya))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(PenelitianBiaya $penelitianBiaya)
    {
        abort_if(Gate::denies('penelitian_biaya_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $penelitianBiaya->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
