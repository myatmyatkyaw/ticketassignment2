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
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            //$table->uuid('uuid')->nullable();
            // $table->foreignId('user_id')->cascadeOnDelete();
            $table->string('title');
            $table->longText('message')->nullable();
            $table->string('priority')->default('low');
            $table->longText('status')->default('open');
            $table->longText('file')->nullable();
            // $table->foreignId('label_id')->cascadeOnDelete();
            // $table->foreignId('category_id')->cascadeOnDelete();

            // $table->boolean('is_resolved')->default(false);
            // $table->boolean('is_locked')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
