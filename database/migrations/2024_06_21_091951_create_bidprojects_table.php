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
        Schema::create('bidprojects', function (Blueprint $table) {
            $table->id();
            $table->string('bidid');
            $table->string('biddocument');
            $table->string('currency');
            $table->integer('amount');
            $table->string('supportingdocument');  //add date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidprojects');
    }
};
