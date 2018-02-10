<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id')->unsigned()->nullable();
            $table->integer('assignee_id')->unsigned()->nullable();
            $table->integer('category')->unsigned()->nullable()->comment('BelongsTo Relation');
            $table->boolean('is_open')->default('1');
            $table->string('title');
            $table->text('description');
            $table->timestamps();

            // Foreign keys constraints
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assignee_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('category')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
}
