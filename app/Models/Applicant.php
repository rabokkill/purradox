<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $fillable = [
        'user_id',
        'job_id',
        'job_title',
        'job_role',
        'application_status',
        'created_at',
        'updated_at'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function job() {
        return $this->belongsTo(Job::class, 'job_id');
    }
}
