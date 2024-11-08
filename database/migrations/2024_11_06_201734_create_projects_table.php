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

            $table->foreignId('created_by')->references('id')->on('users')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('updated_by')->nullable()->references('id')->on('users')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('status_id')->references('id')->on('statuses')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('priority_id')->references('id')->on('priorities')->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->string('name')->unique();
            $table->longText('description');
            $table->date('start_date');
            $table->date('due_date')->nullable();
            $table->string('image_path')->nullable();

            $table->timestamps();
            $table->softDeletes();
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
