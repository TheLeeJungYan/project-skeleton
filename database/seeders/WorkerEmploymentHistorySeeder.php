<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkerEmploymentHistory;
use App\Models\Worker;
use Carbon\Carbon;
use Faker\Factory as Faker;
class WorkerEmploymentHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        Worker::all()->each(function ($worker) use ($faker) {
            
            $previousEndDate = null;
            $max = 3;
            $employmentHistoryCount = rand(1, $max);
        
            for ($i = 0; $i < $employmentHistoryCount; $i++) {
                $startDate = $previousEndDate ? Carbon::parse($previousEndDate)->addDay(rand(1,360)) : Carbon::now()->subYears(rand(1, 5)); 
                $endDate = $i < $employmentHistoryCount - 1 ? Carbon::parse($startDate)->addMonths(rand(3, 24)) : (rand(0,1)?Carbon::parse($startDate)->addMonths(rand(3, 24)):null); 
                
                if ($endDate && $endDate > Carbon::today()) {
                    $i = $max;
                    $endDate = Carbon::today();
                }
                WorkerEmploymentHistory::create([
                    'workerId' => $worker->id,
                    'companyName' => $faker->company,
                    'jobTitle' => $faker->jobTitle,
                    'startDate' => $startDate,
                    'endDate' => $endDate,
                ]);
        
                $previousEndDate = $endDate; 
            }
        });
    }
}
