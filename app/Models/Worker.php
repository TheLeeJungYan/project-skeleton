<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Worker extends Model
{
    use SoftDeletes;

    protected $table = 'workers';

    protected $fillable = [
        'firstName','lastName','email'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function employmentHistories(){
        return $this->hasMany(WorkerEmploymentHistories::class);
    }
}
