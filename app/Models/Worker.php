<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Worker extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'workers';

    protected $fillable = [
        'firstName','lastName','email'
    ];

    protected $dates = [
        'deleted_at'
    ];

    public function workerEmploymentHistories(){
        return $this->hasMany(WorkerEmploymentHistory::class,'workerId');
    }

}
