<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSignatureTable
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten and his contributors
 */
class CreateSignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('signatures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('petition_id')->unsigned(); 
            $table->integer('country_id')->nullable()->unsigned();
            $table->string('firstname'); 
            $table->string('lastname'); 
            $table->string('city');
            $table->string('email');
            $table->timestamps();

            // Foreign key constraints 
            $table->foreign('petition_id')->references('id')->on('petitions')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('signatures');
    }
}
