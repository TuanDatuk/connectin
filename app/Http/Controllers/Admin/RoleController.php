<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RoleDataTable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repositories\RoleRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\Admin\RoleRequest;
use App\Repositories\PermissionRepository;

class RoleController extends Controller
{
    protected $role;

    protected $permission;

    public function __construct(RoleRepository $role, PermissionRepository $permission)
    {
        $this->role       = $role;
        $this->permission = $permission;
    }

    public function index(RoleDataTable $dataTable)
    {
        Gate::authorize('roles.index');

        return $dataTable->render('backend.admin.role.all-role');
    }

    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $pemissions = $this->permission->all();
        $data       = [
            'pemissions' => $pemissions,
        ];

        return view('backend.admin.role.add-role', $data);
    }

    public function store(RoleRequest $request): \Illuminate\Http\JsonResponse
    {
        if (isDemoMode()) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        DB::beginTransaction();
        try {
            $this->role->store($request->all());
            DB::commit();
            Toastr::success(__('create_successful'));
            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('roles.index'),
            ]);

        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false,'error' => __('something_went_wrong_please_try_again')]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $role       = $this->role->edit($id);
            $pemissions = $this->permission->all();
            $data       = [
                'pemissions' => $pemissions,
                'role'       => $role,
            ];

            return view('backend.admin.role.edit-role', $data);
        }catch (\Exception $e) {
            Toastr::error('something_went_wrong_please_try_again');
            return back();
        }
    }

    public function update(RoleRequest $request, $id): \Illuminate\Http\JsonResponse
    {
        if (isDemoMode()) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        DB::beginTransaction();
        try {
            $this->role->update($request->all(), $id);

            DB::commit();
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
                'route'   => route('roles.index'),
            ]);
        }catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => false,'error' => __('something_went_wrong_please_try_again')]);
        }
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        if (isDemoMode()) {
            $data = [
                'status'  => 'danger',
                'message' => __('this_function_is_disabled_in_demo_server'),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
        try {
            $this->role->destroy($id);
            $data = [
                'status'  => 'success',
                'message' => __('delete_successful'),
                'title'   => 'success',
            ];

            return response()->json($data);
        }catch (\Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => __('something_went_wrong_please_try_again'),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }
}
