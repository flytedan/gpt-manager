<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artifacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('model');
            $table->text('content')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('artifactables', function (Blueprint $table) {
            $table->bigIncrements('id')->primary();
            $table->foreignId('artifact_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('artifactable_id');
            $table->string('artifactable_type');
            $table->string('category')->default('');
            $table->timestamps();

            $table->index(['artifactable_id', 'artifactable_type'], 'artifactables_artifactable_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artifacts');
    }
};
