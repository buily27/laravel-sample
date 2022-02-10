<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository\BaseRepository;
use Illuminate\Support\Carbon;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * lấy model tương ứng
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * get all
     *  @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getList()
    {
        return $this->model->with('department', 'role')
            ->search()
            ->sort()
            ->filterByDepartment()
            ->filterByWorkStatus()
            ->paginate(config('common.ITEMS_PERPAGE'));
    }

    /**
     * get list user in the same department
     * @param int $department_id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getMemberByDepartment($department_id)
    {
        return $this->model->with('department', 'role')
            ->wheredepartment_id($department_id)
            ->whererole_id(config('common.IS_MEMBER'))
            ->search()
            ->sort()
            ->filterByWorkStatus()
            ->paginate(config('common.ITEMS_PERPAGE'));
    }

    /**
     *  get all management
     *  @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function findManagerByDepartment($department_id)
    {
        return $this->model->with('department', 'role')->wheredepartment_id($department_id)->whererole_id(config('common.IS_MANAGEMENT'))->first();
    }

    /**
     *  get list user to export
     *  @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function export()
    {
        return $this->model->with('department', 'role')
            ->search()
            ->sort()
            ->filterByDepartment()
            ->filterByWorkStatus()
            ->get();
    }

    /**
     *  get list user by department to export
     *  @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function exportDepartment($department_id)
    {
        return $this->model->with('department', 'role')
            ->wheredepartment_id($department_id)
            ->whererole_id(config('common.IS_MEMBER'))
            ->search()
            ->sort()
            ->filterByWorkStatus()
            ->get();
    }

    public function getListUsersHaveBirthday($department_id){
        $data = $this->model->wheredepartment_id($department_id)
                            ->whereMonth('dob', '=',Carbon::now()->month)
                            ->whereDay('dob', '=', Carbon::now()->day)
                            ->whererole_id(config('common.IS_MEMBER'))->get();
        return $data;
    }
}
