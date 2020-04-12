<?php

namespace App\Http\Controllers\Admin;

use App\Dosen;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreReviewerRequest;
use App\Http\Requests\UpdateReviewerRequest;
use App\Reviewer;
use App\Role;
use Gate;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ReviewerController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('reviewer_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reviewers = Reviewer::all();
        $reviewers->load('dosen');
        $reviewersDosens = Reviewer::pluck('id');
        $dosens = Dosen::whereNotIn('id',$reviewersDosens)
            ->pluck('nama','id');

        return view('admins.reviews.reviewers.index', compact('reviewers','dosens'));
    }


    public function store(StoreReviewerRequest $request)
    {
        DB::transaction(function () use ($request) {
            $reviewer = Reviewer::create($request->all()+['status' => 1]);
            $role = Role::where('title','Reviewer')->first();
            $reviewer->dosen->user->roles()->attach(optional($role)->id);
        });

        return redirect()->route('admin.reviewers.index');
    }


    public function update(UpdateReviewerRequest $request, $id)
    {
        $reviewer = Reviewer::findOrFail($id);
        $reviewer->update($request->all());
        return redirect()->route('admin.reviewers.index');
    }


    public function destroy($id)
    {
        abort_if(Gate::denies('reviewer_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $reviewer = Reviewer::findOrFail($id);
        $role = Role::where('title','Reviewer')->first();
        $reviewer->dosen->user->roles()->detach(optional($role)->id);
        $reviewer->delete();

        return back();
    }
}
