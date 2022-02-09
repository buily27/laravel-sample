<?php

namespace App\Repositories\User;

use App\Repositories\BaseRepository\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getMemberByDepartment($department_id);
    public function findManagerByDepartment($department_id);
    public function getList();
    public function exportDepartment($department_id);
    public function export();
}
