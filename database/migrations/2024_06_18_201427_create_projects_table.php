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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('projectreferencenumber');    
            $table->string('projecttitle');
            $table->text('projectdetails');
            $table->string('location');
            $table->boolean('opentolocalbusinesses');
            $table->boolean('openinternationally');       
            $table->string('preferredbiddingcurrency1'); 
            $table->boolean('makecurrencymandatory');  // yes or no
            $table->string('preferredbiddingcurrency2');
            $table->boolean('limitbidamount');  //include limit bid amount?
            $table->integer('bidamount');
            $table->date('startdate');
            $table->time('starttime');
            $table->date('enddate');
            $table->time('endtime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
