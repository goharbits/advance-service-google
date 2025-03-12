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
        Schema::create('tasks', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('title');
            $table->string('color');
            $table->integer('priority');
            $table->longText('description')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};