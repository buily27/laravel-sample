<?php

namespace App\Exports;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    use Exportable;
    /**
     * UserRepositoryInterface
     *
     * @var object
     */
    private $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->user->getAll();
    }

    public function view(): View
    {
        if (Auth::user()->is_admin == config('common.IS_ADMIN')) {
            $users = $this->user->export();
        } else {
            $users = $this->user->exportDepartment(Auth::user()->department_id);
        }
        return view('excel.users', [
            'users' => $users
        ]);
    }
}
