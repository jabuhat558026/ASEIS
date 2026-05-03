<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            // USER RELATION
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // COURSE RELATION
            $table->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete();

            // ENROLLMENT STATUS
            $table->enum('status', ['active', 'completed', 'dropped'])
                ->default('active');

            // DATE OF ENROLLMENT
            $table->date('enrollment_date')->nullable();

            $table->timestamps();

            // PREVENT DUPLICATE ENROLLMENT
            $table->unique(['user_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};