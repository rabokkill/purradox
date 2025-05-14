<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'applicant_id',
        'job_id',
        'job_title',
        'job_role',
        'employment_status',
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function applicant() {
        return $this->belongsTo(Applicant::class, 'applicant_id');
    }

    public function job() {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->last_name}, {$this->first_name}";
    }
}
