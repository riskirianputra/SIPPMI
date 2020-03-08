<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJenisUsulanRequest;
use App\Http\Requests\UpdateJenisUsulanRequest;
use App\Http\Resources\Admin\JenisUsulanResource;
use App\JenisUsulan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JenisUsulanApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('jenis_usulan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JenisUsulanResource(JenisUsulan::all());
    }

    public function store(StoreJenisUsulanRequest $request)
    {
        $jenisUsulan = JenisUsulan::create($request->all());

        return (new JenisUsulanResource($jenisUsulan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(JenisUsulan $jenisUsulan)
    {
        abort_if(Gate::denies('jenis_usulan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JenisUsulanResource($jenisUsulan);
    }

    public function update(UpdateJenisUsulanRequest $request, JenisUsulan $jenisUsulan)
    {
        $jenisUsulan->update($request->all());

        return (new JenisUsulanResource($jenisUsulan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(JenisUsulan $jenisUsulan)
    {
        abort_if(Gate::denies('jenis_usulan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jenisUsulan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
