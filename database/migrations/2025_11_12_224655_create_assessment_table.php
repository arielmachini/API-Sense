<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('assessments', function (Blueprint $table) {
            $table->uuid('code')->unique(); // Unique identifier for saving and restoring progress.
            $table->timestamps();
            $table->json('oas')->nullable(); // OpenAPI specification (JSON) provided by the user.
            $table->json('progress'); // Values for metrics that have been set by the user or computed automatically.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('assessments');
    }
};
