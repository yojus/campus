<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            // $table->foreignId('subject_id')
            //     ->constrained()
            //     ->cascadeOnUpdate()
            //     ->cascadeOnDelete();
            // $table->string('subject_id');
            $table->string('school');
            $table->string('money');
            $table->string('area');
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
        Schema::dropIfExists('class_offers');
    }
}
