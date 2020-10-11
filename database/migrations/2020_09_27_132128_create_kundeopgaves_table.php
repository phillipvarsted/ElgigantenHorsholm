<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKundeopgavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kundeopgaver', function (Blueprint $table) {
            $table->id();
            $table->integer('salgs_id')->nullable();
            $table->string('produkt')->nullable();
            $table->string('service')->nullable();
            $table->integer('status')->nullable();
            $table->datetime('datetime')->nullable();
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
        Schema::dropIfExists('kundeopgaver');
    }
}
