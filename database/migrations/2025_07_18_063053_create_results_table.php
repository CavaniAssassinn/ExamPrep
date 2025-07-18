<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * It runs the migrations.
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_id')->constrained()->onDelete('cascade');
            $table->string('subject');
            $table->integer('marks');
            $table->timestamps();
        });
    }


    /**
     * This will reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
