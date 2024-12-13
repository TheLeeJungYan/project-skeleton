<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class WorkerEmploymentHistory extends Model
{
    use SoftDeletes;

    protected $table = 'workerEmploymentHistories';

    protected $fillable = [
        'workerId','companyName','jobTitle','startDate', 'endDate',
    ];

    protected $dates = [
        'startDate','endDate','deleted_at'
    ];

    public function worker(){
        return $this->belongsTo(Worker::class, 'workerId');
    }
}
