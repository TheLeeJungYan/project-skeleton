<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class WorkerEmploymentHistory extends Model
{
    use SoftDeletes;
    use HasFactory;
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
