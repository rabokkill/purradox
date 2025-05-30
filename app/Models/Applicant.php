<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'job_id',
        'job_title',
        'job_role',
        'application_status',
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id');
    }

    public function job() {
        return $this->belongsTo(Job::class, 'id');
    }

    public function getFullNameAttribute()
    {
        return "{$this->last_name}, {$this->first_name}";
    }
}
