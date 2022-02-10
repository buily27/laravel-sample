<?php

namespace App\Console\Commands;

use App\Jobs\SendMail;
use App\Repositories\Department\DepartmentRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Console\Command;

class UserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'HPBD';

    /**
     * UserRepositoryInterface
     *
     * @var object
     */
    private $user;

    /**
     * DepartmentRepositoryInterface
     *
     * @var object
     */
    private $department;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $user, DepartmentRepositoryInterface $department)
    {
        parent::__construct();
        $this->user = $user;
        $this->department = $department;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $departments = $this->department->getListDepartmentHasUserBirthday();
        if (count($departments)) {
            $listManagers = array();
            $messages = array();
            foreach ($departments as $department) {
                $messages['messages'] = [
                    'title' => __('messages.hpbd'),
                    'task' => __('messages.list_member_have_birthday'),
                    'data' => '',
                ];
                $manager = $this->user->findManagerByDepartment($department->id);
                if (!is_null($manager)) {
                    array_push($listManagers, $manager);
                    $message = [
                        'title' => __('messages.hpbd'),
                        'task' => __('messages.list_member_have_birthday'),
                        'data' => '',
                    ];
                    $listUsersHaveBirthday = $this->user->getListUsersHaveBirthday($department->id);
                    foreach ($listUsersHaveBirthday as $user) {
                        $message['data'] .= $user->name . ", ";
                    }
                    array_push($messages, $message);
                }
            }
            SendMail::dispatch($messages, $listManagers);
        }
    }
}
