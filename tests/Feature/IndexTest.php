<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use PDOException;
use Tests\TestCase;

class IndexTest extends TestCase
{
    public function testShouldReturnAllOkResponseWhenRunningProperly()
    {
        DB::shouldReceive('getPdo')->andReturn(true);
        $this->json('GET', '/')->assertJson([
            'container' => 'OK',
            'database' => 'OK',
        ]);
    }

    public function testShouldReturnDbFailureWhenDbNotWorking()
    {
        DB::shouldReceive('getPdo')->andThrow(PDOException::class);
        $this->json('GET', '/')->assertJson([
            'container' => 'OK',
            'database' => 'FAILURE',
        ]);
    }
}
