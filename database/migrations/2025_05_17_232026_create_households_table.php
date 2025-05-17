<?php

use App\Models\Household;
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
        Schema::create('households', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Household::class);
        });

        Schema::table('plans', function (Blueprint $table) {
            $table->foreignIdFor(Household::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(Household::class);
        });

        Schema::table('plans', function (Blueprint $table) {
            $table->dropConstrainedForeignIdFor(Household::class);
        });

        Schema::dropIfExists('households');
    }
};
