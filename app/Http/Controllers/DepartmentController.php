<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Repositories\Department\DepartmentRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * DepartmentRepositoryInterface
     *
     * @var object
     */
    private $department;

    /**
     * UserRepositoryInterface
     *
     * @var object
     */
    private $user;

    public function __construct(DepartmentRepositoryInterface $department, UserRepositoryInterface $user)
    {
        $this->department = $department;
        $this->user = $user;
    }

    /**
     * Get all
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */

    public function index()
    {
        $allDepartment = $this->department->getList();

        return view('departments.list', compact("allDepartment"));
    }

    /**
     * create
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('departments.add');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(DepartmentRequest $request)
    {
        $data['name'] = $request->name;
        $data['description'] = $request->description;
        $this->department->store($data);
        session()->flash('success', __('messages.create_success'));
        return redirect()->route('department');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @@return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     */
    public function edit($id)
    {
        $dataDepartment = $this->department->find($id);
        if (is_null($dataDepartment)) {
            return redirect('404');
        }
        return view('departments.edit', compact('dataDepartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(DepartmentRequest $request, $id)
    {
        $dataDepartment = $this->department->find($id);
        if (is_null($dataDepartment)) {
            return redirect('404');
        }
        $data = $request->except("_token");
        $old_manager = $this->user->findManagerByDepartment($id);
        if (isset($request->user_id)) {
            $new_manager = $this->user->find($data['user_id']);
        }
        if (isset($old_manager)) {
            if ($old_manager->id != $data['user_id']) {
                $old_manager_role['role_id'] = config('common.IS_MEMBER');
                $this->user->update($old_manager_role, $old_manager->id);
                $new_manager_role['role_id'] = config('common.IS_MANAGEMENT');
                $this->user->update($new_manager_role, $new_manager->id);
            }
        }


        $this->department->update($data, $id);
        session()->flash('success', __('messages.update_success'));
        return redirect()->route('department');
    }

    /**
     * Delete single department
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id)
    {
        $department = $this->department->find($id);
        if (is_null($department)) {
            return redirect('404');
        }
        if (Auth::user()->can('delete', $department)) {
            $this->department->delete($id);
            session()->flash('success',  __('messages.delete_success'));
        } else {
            session()->flash('error',  __('messages.delete_error'));
        }

        return redirect()->route('department');
    }
}
