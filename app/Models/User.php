<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    /**
     * Get the department associated with the user.
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    /**
     * scopeSearch
     *
     * @param  mixed $query
     * @return string
     */
    public function scopeSearch($query)
    {
        if (isset( request()->keyword)) {
            $keyword = request()->keyword;
            $query = $query->where('name', 'like', '%' . $keyword . '%');
        }
        return $query;
    }

    /**
     * scopeSort
     *
     * @param  mixed $query
     * @return string
     */
    public function scopeSort($query)
    {
        if (isset(request()->sort_by)) {
            if (isset(request()->sort_type)) {
                $type = request()->sort_type;
            } else {
                $type = "asc";
            }
            $query = $query->orderBy(request()->sort_by, $type);
        }
        return $query;
    }

    /**
     * scopeFilterByDepartment
     *
     * @param  mixed $query
     * @return string
     */
    public function scopeFilterByDepartment($query)
    {
        if ( isset(request()->department_id)) {
            $value = request()->department_id;
            $query = $query->where('department_id', '=', $value);
        }
        return $query;
    }

    /**
     * scopeFilterByWorkStatus
     *
     * @param  mixed $query
     * @return string
     */
    public function scopeFilterByWorkStatus($query)
    {
        if (isset(request()->work_status)) {
            $work_status = request()->work_status;
            if ($work_status == 'working') {
                $query = $query->where('work_status', '=', config('common.IS_WORK'));
            }
            if ($work_status == 'quit') {
                $query = $query->where('work_status', '=', config('common.QUIT'));
            }
        }
        return $query;
    }
}
