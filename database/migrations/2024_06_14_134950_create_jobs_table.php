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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('jobid');
            $table->string('jobtitle');
            $table->string('workplacetype');
            $table->string('worktype');
            $table->string('employmentlocation');
            $table->text('jobdescription');
            $table->text('requiredskills');
            $table->text('additionalskills');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
