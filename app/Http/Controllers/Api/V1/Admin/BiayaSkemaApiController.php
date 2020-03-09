<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\BiayaSkema;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBiayaSkemaRequest;
use App\Http\Requests\UpdateBiayaSkemaRequest;
use App\Http\Resources\Admin\BiayaSkemaResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BiayaSkemaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('biaya_skema_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BiayaSkemaResource(BiayaSkema::with(['biaya'])->get());
    }

    public function store(StoreBiayaSkemaRequest $request)
    {
        $biayaSkema = BiayaSkema::create($request->all());

        return (new BiayaSkemaResource($biayaSkema))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BiayaSkema $biayaSkema)
    {
        abort_if(Gate::denies('biaya_skema_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BiayaSkemaResource($biayaSkema->load(['biaya']));
    }

    public function update(UpdateBiayaSkemaRequest $request, BiayaSkema $biayaSkema)
    {
        $biayaSkema->update($request->all());

        return (new BiayaSkemaResource($biayaSkema))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BiayaSkema $biayaSkema)
    {
        abort_if(Gate::denies('biaya_skema_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $biayaSkema->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
