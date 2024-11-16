<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::withTrashed()->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        Role::create($request->all());

        return redirect()->route('roles.index')
            ->with('success', 'Thêm vai trò thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role->update($request->all());

        return redirect()->route('roles.index')
            ->with('success', 'Sửa vai trò thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'Ẩn vai trò thành công');
    }

    public function restore($id)
    {
        $vaitro = Role::onlyTrashed()->findOrFail($id);
        $vaitro->restore();

        return redirect()->route('roles.index')
            ->with('success', 'Khôi phục vai trò thành công');
    }

    public function forceDelete($id)
    {
        $vaitro = Role::onlyTrashed()->findOrFail($id);
        $vaitro->forceDelete();

        return redirect()->route('roles.index')
            ->with('success', 'Xóa vai trò thành công');
    }
}
