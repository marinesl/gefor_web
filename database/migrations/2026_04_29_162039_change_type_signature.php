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
        Schema::table('signature', function (Blueprint $table) {
            // PostgreSQL: change column type to TEXT to store long base64 strings
            DB::statement('ALTER TABLE signature ALTER COLUMN signature TYPE TEXT');

            // For MySQL: LONGTEXT is safe for big base64 images
            //$table->longText('signature')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('signature', function (Blueprint $table) {
            // Revert back to VARCHAR(255) if needed
            DB::statement('ALTER TABLE signature ALTER COLUMN signature TYPE VARCHAR(255)');

            // Revert back to VARCHAR(255) if needed
            //$table->string('signature', 255)->change();
        });
    }
};
