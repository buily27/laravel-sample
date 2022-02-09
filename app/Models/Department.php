<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * Get the list user associated with the department.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'department_id', 'id');
    }
}
