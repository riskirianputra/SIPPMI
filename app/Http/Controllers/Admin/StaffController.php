<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStaffRequest;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Role;
use App\Staff;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StaffController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('staff_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff = Staff::all();

        return view('admin.staff.index', compact('staff'));
    }

    public function create()
    {
        abort_if(Gate::denies('staff_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staff.create');
    }

    public function store(StoreStaffRequest $request)
    {
        $user = new User();
        $user->name = request('nama');
        $user->email = request('email');
        $user->password = bcrypt(request('nip'));
        $user->username = request('nip');
        $user->type = 'D';
        $user->save();

        $role = Role::where('title', 'Admin LPPM')->first();
        $user->roles()->sync([$role->id]);

        $staff = Staff::create(array_merge($request->all(), ['id' => $user->id]));

        return redirect()->route('admin.staff.index');
    }

    public function edit(Staff $staff)
    {
        abort_if(Gate::denies('staff_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staff.edit', compact('staff'));
    }

    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        $staff->update($request->all());

        return redirect()->route('admin.staff.index');
    }

    public function show(Staff $staff)
    {
        abort_if(Gate::denies('staff_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.staff.show', compact('staff'));
    }

    public function destroy(Staff $staff)
    {
        abort_if(Gate::denies('staff_manage'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $staff->delete();

        return back();
    }

    public function massDestroy(MassDestroyStaffRequest $request)
    {
        Staff::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
