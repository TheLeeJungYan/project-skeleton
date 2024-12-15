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

    public function toArray(){
        $worker = Worker::with('workerEmploymentHistories')->find($this->id);
    
        $attributes = parent::toArray();
    
        // Now, the workerEmploymentHistories relationship is already loaded, so we can access it without additional queries
        $attributes['employments'] = $worker->workerEmploymentHistories->map(function ($employment) {
            return [
                'id' => $employment->id,
                'companyName' => $employment->companyName,
                'jobTitle' => $employment->jobTitle,
                'startDate' => $employment->startDate,
                'endDate' => $employment->endDate,
            ];
        });

        unset($attributes['worker_employment_histories']);
        return $attributes;
    }
}
