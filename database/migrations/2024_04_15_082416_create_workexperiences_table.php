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
        Schema::create('workexperiences', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->text('companyname');
            $table->string('jobtitle');
            $table->string('jobdescription');
            $table->boolean('activework')->unsigned()->nullable();
            $table->string('startdate');
            $table->string('enddate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workexperiences');
    }
};
