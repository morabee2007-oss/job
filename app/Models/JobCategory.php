<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public function jobPosts()
    {
        return $this->hasMany(Job::class, 'job_category_id');
    }
}
