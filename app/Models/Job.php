<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
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

    public function jobApplicants()
    {
        return $this->hasMany(Applicant::class, 'job_id');
    }

    public function jobEmployees()
    {
        return $this->hasMany(Employee::class, 'job_id');
    }
}
