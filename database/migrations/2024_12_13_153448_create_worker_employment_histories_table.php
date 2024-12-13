<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workerEmploymentHistories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workerId');
            $table->string('companyName');                
            $table->string('jobTitle');
            $table->date('startDate');
            $table->date('endDate')->nullable();
            $table->timestamps();
            $table->softDeletes();
        
            $table->foreign('workerId')->references('id')->on('workers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workerEmploymentHistories');
    }
};
