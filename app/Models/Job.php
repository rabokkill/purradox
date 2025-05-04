<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'job_dept',
        'job_title',
        'job_role',
        'job_salary',
        'job_desc',
        'job_slots',
        'created_at',
        'updated_at'
    ];
}
