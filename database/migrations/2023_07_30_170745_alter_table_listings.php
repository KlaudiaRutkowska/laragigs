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
        Schema::table('listings', function (Blueprint $table) {
            $table->string('tags')->after('title')->nullable();
            $table->string('company');
            $table->string('location');
            $table->string('email');
            $table->string('website');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropColumn('tags');
            $table->dropColumn('company');
            $table->dropColumn('location');
            $table->dropColumn('email');
            $table->dropColumn('website');
        });
    }
};
