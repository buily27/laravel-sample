<?php

namespace App\Repositories\Department;

use App\Repositories\BaseRepository\BaseRepositoryInterface;

interface DepartmentRepositoryInterface extends BaseRepositoryInterface
{
    public function getListUsersHaveBirthday();
    public function getList();
}
