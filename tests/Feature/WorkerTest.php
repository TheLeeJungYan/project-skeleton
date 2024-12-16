<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\DatabaseSeeder;
use Faker\Factory as Faker;

class WorkerTest extends TestCase
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
    
    public function testGetAllWorkers(): void
    {
        $response = $this->getJson('/worker');
        $response->assertStatus(200)
             ->assertJsonStructure([
                 'data' => [
                     'workers' => [
                         '*' => [
                             'id',
                             'firstName',
                             'lastName',
                             'email',
                             'employments' => [
                                 '*' => [
                                     'id',
                                     'companyName',
                                     'jobTitle',
                                     'startDate',
                                     'endDate',
                                 ]
                             ]
                         ]
                     ]
                 ]
             ]);
    }

    public function testCreateNewWorkers():void
    {
        $faker = Faker::create();
        $email = $faker->unique()->email;
        while (\App\Models\Worker::where('email', $email)->exists()) {
            $email = $faker->unique()->email;
        }
        $workerData = [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => $email,
        ];

        $response = $this->postJson('/worker', $workerData);
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id',
            ]
        ]);
    
        $this->assertDatabaseHas('workers', [
            'email' => $email,
        ]);
    }
}
