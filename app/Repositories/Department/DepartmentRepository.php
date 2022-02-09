<?php

namespace App\Repositories\Department;

use App\Models\Department;
use App\Repositories\BaseRepository\BaseRepository;
use Carbon\Carbon;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    /**
     * lấy model tương ứng
     */
    public function getModel()
    {
        return Department::class;
    }

    /**
     * get all
     *  @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getList()
    {
        return $this->model->with('users')->paginate(config('common.ITEMS_PERPAGE'));
    }

    /**
     * get One
     * 
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function find($id)
    {
        $data = $this->model->with('users')->find($id);
        return $data;
    }

    public function getListUsersHaveBirthday()
    {
        $data = $this->model->with(['users' => function ($query) {
            $query->whereMonth('dob', '=', Carbon::now()->month)->whereDay('dob', '=', Carbon::now()->day)->whererole_id(config('common.IS_MEMBER'));
        }])->get();
        return $data;
    }
}
