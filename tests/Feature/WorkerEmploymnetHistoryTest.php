<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;
use App\Models\Worker;
use App\Models\WorkerEmploymentHistory;
use Carbon\Carbon;
class WorkerEmploymnetHistoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;
    public function setup():void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }
    public function testCreateWorkerEmploymentHistory(): void
    {
        $worker = Worker::doesntHave('workerEmploymentHistories')
        ->orWhereDoesntHave('workerEmploymentHistories', function ($query) {
            $query->whereNull('endDate'); 
        })
        ->first();
        $employmentData = [
            'workerEmail' => $worker->email, 
            'companyName' => 'Example Company',
            'jobTitle' => 'Software Engineer',
            'startDate' => '2025-01-01',
        ];
        $response = $this->postJson('/employment',$employmentData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('workerEmploymentHistories', [
            'workerId' => $worker->id,
            'companyName' => 'Example Company',
            'jobTitle' => 'Software Engineer',
            'startDate' => '2025-01-01',
            'endDate' => null,
        ]);
    }

    public function testUpdateWorkerEmploymentHistory(): void
    {
        $workerEmploymentHistory = WorkerEmploymentHistory::with('worker')->whereNull('endDate')->first()
        ->first();
        $endDate = Carbon::now()->format('Y-m-d');
        $employmentData = [
            'workerEmploymentId' => $workerEmploymentHistory->id, 
            'endDate' => $endDate,
        ];

        $response = $this->patchJson('/employment',$employmentData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('workerEmploymentHistories', [
            'workerId' => $workerEmploymentHistory->worker->id,
            'companyName' => $workerEmploymentHistory->companyName,
            'jobTitle' => $workerEmploymentHistory->jobTitle,
            'startDate' => $workerEmploymentHistory->startDate,
            'endDate' => $endDate,
        ]);
    }
}
