<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_ticket', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('label_id')->cascadeOnDelete();
            // $table->foreignId('ticket_id')->cascadeOnDelete();
            $table->unsignedBigInteger('label_id');
            $table->unsignedBigInteger('ticket_id');
            $table->timestamps();
            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('label_ticket');
    }
}
