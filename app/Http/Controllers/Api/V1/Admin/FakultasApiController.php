<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Fakultum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFakultumRequest;
use App\Http\Requests\UpdateFakultumRequest;
use App\Http\Resources\Admin\FakultumResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FakultasApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fakultum_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FakultumResource(Fakultum::all());
    }

    public function store(StoreFakultumRequest $request)
    {
        $fakultum = Fakultum::create($request->all());

        return (new FakultumResource($fakultum))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateFakultumRequest $request, Fakultum $fakultum)
    {
        $fakultum->update($request->all());

        return (new FakultumResource($fakultum))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Fakultum $fakultum)
    {
        abort_if(Gate::denies('fakultum_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fakultum->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
