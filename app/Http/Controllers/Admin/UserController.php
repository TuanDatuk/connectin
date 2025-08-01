<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function statusChange(Request $request): \Illuminate\Http\JsonResponse
    {
        if (isDemoMode()) {
            Toastr::error(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        try {
            $this->user->statusChange($request->all());
            $data = [
                'status'  => 'success',
                'message' => __('update_successful'),
                'title'   => 'success',
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'status'  => 'danger',
                'message' => $e->getMessage(),
                'title'   => __('error'),
            ];

            return response()->json($data);
        }
    }

    public function userBan($id): \Illuminate\Http\RedirectResponse
    {
        if (isDemoMode()) {
            Toastr::error(__('this_function_is_disabled_in_demo_server'));

            return back();
        }
        try {
            $response = $this->user->userBan($id);
            Toastr::success(__($response['message']));

            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            if (config('app.debug')) {
                dd($e->getMessage());            
            }
            
            return redirect()->back();
        }
    }

    // public function instructorDelete($id): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    // {
    //     if (isDemoMode()) {
    //         $data = [
    //             'status'  => 'danger',
    //             'message' => __('this_function_is_disabled_in_demo_server'),
    //             'title'   => 'error',
    //         ];

    //         return response()->json($data);
    //     }
    //     try {
    //         $response = $this->user->userDelete($id);

    //         $data     = [
    //             'status'  => 'success',
    //             'message' => __($response['message']),
    //             'title'   => 'success',
    //         ];

    //         return response()->json($data);
    //     } catch (Exception $e) {
    //         $data = [
    //             'status'  => 'danger',
    //             'message' => $e->getMessage(),
    //             'title'   => 'error',
    //         ];

    //         return response()->json($data);
    //     }
    // }
}
