<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ProfileRequest;
use App\Imports\UsersImport;
use App\Jobs\SendMail;
use App\Repositories\Department\DepartmentRepositoryInterface;
use App\Repositories\Role\RoleRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;

class UserController extends Controller
{
    /**
     * UserRepositoryInterface
     *
     * @var object
     */
    private $user;

    /**
     * RoleRepositoryInterface
     *
     * @var object
     */
    private $role;

    /**
     * DepartmentRepositoryInterface
     *
     * @var object
     */
    private $department;

    public function __construct(UserRepositoryInterface $user, DepartmentRepositoryInterface $department, RoleRepositoryInterface $role)
    {
        $this->user = $user;
        $this->role = $role;
        $this->department = $department;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        if (Auth::user()->is_admin == config('common.IS_ADMIN')) {
            $allUsers = $this->user->getList();
        } else {
            $allUsers = $this->user->getMemberByDepartment(Auth::user()->department_id);
        }
        $allDepartments = $this->department->getAll();
        return view('users.list', compact(["allUsers", "allDepartments"]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        $allRoles = $this->role->getAll();
        $allDepartments = $this->department->getAll();
        return view('users.add', compact(["allRoles", "allDepartments"]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
        $data = $request->except("_token", "is_admin");
        if ($request->is_admin) {
            $data['is_admin'] = config('common.IS_ADMIN');
        }
        if ($data['role_id'] == config('common.IS_MANAGEMENT')) {
            $checkManager = $this->user->findManagerByDepartment($data['department_id']);
            if (!is_null($checkManager)) {
                session()->flash('error', __('messages.exists_manager'));
                return redirect()->route('user.create');
            }
        }
        $data['work_status'] = config('common.IS_WORK');
        $data['is_first_login'] = config('common.IS_FIRST_LOGIN');

        $password = Str::random(10);
        $message = [
            'title' => __('messages.new_member'),
            'task' => __('messages.welcome'),
            'data' => $password
        ];
        $job = (new SendMail($message, $data['username']));
        $this->dispatch($job);
        $data['password'] = Hash::make($password);

        if (!empty($request->file('image'))) {
            $request->file('image')->store('public');
            $data['image'] = $request->file('image')->hashName();
        }
        $this->user->store($data);
        session()->flash('success', __('messages.create_success'));
        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */

    public function edit($id)
    {
        $dataUser = $this->user->find($id);
        if (is_null($dataUser)) {
            return redirect('404');
        }
        $allRoles = $this->role->getAll();
        $allDepartments = $this->department->getAll();
        return view('users.edit', compact(["dataUser", "allRoles", "allDepartments"]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        $dataUser = $this->user->find($id);
        if (is_null($dataUser)) {
            return redirect('404');
        }
        
        $data = $request->except("_token", "old_image", "is_admin");
        if (Auth::user()->role_id != $data['role_id'] && Auth::user()->id == $dataUser['id']) {
            session()->flash('error', __('messages.change_role_self'));
            return redirect()->back();
        }

        if (!is_null($request->is_admin)) {
            $data['is_admin'] = config('common.IS_ADMIN');
           
        }else{
            if(Auth::user()->id != $dataUser->id){
                $data['is_admin'] = config('common.IS_NOT_ADMIN');
            }
        }
        $checkManager = $this->user->findManagerByDepartment($data['department_id']);

        if ($data['role_id'] == config('common.IS_MANAGEMENT')) {
            if ($dataUser['department_id'] != $data['department_id']) {
                if (!is_null($checkManager)) {
                    session()->flash('error', __('messages.exists_manager'));
                    return redirect()->back();
                }
            } else {
                if (!is_null($checkManager) && $dataUser['role_id'] != config('common.IS_MANAGEMENT')) {
                    session()->flash('error', __('messages.exists_manager'));
                    return redirect()->back();
                }
            }
        }
        if (!empty($request->file('image'))) {
            $request->file('image')->store('public');
            $data['image'] = $request->file('image')->hashName();
            if (!empty($request->old_image)) {
                Storage::delete('/public/' . $request->old_image);
            }
        }
        $this->user->update($data, $id);
        session()->flash('success', __('messages.update_success'));
        return redirect()->route('user.index');
    }

    /**
     * Delete single user
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);
        if (is_null($user)) {
            return redirect('404');
        }
        if (Auth::user()->can('delete', $user)) {
            $this->user->delete($id);
            session()->flash('success',  __('messages.delete_success'));
        } else {
            session()->flash('error',  __('messages.delete_self'));
        }
        return redirect()->route('user.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(ProfileRequest $request)
    {
        $data = $request->except("_token", "old_image");
        if (!empty($request->file('image'))) {
            $request->file('image')->store('public');
            $data['image'] = $request->file('image')->hashName();
            if (!empty($request->old_image)) {
                Storage::delete('/public/' . $request->old_image);
            }
        }
        if ($this->user->update($data, Auth::user()->id)) {
            session()->flash('success', __('messages.update_success'));
        }
        return redirect()->route('profile');
    }

    /**
     * change password
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $data['password'] = Hash::make($request->password);
        $data['is_first_login'] = config('common.NOT_FIRST_LOGIN');
        $this->user->update($data, Auth::user()->id);
        session()->flash('success', __('messages.update_password'));
        return redirect()->route('profile');
    }


    /**
     * export Excel
     *
     * @param  object $excel
     * @param  object $export
     * @return void
     */
    public function export(Excel $excel, UsersExport $export)
    {
        return $excel->download($export, 'Thông tin nhân viên_' . Carbon::now()->format('Y-m-d_H:i:s') . '.xlsx');
    }

}
