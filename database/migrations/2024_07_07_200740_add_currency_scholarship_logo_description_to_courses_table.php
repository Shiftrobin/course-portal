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
        Schema::table('courses', function (Blueprint $table) {
            //
            $table->string('currency')->nullable()->after('slug');
            $table->string('scholarship')->nullable()->after('fees');
            $table->longText('description')->nullable()->after('scholarship');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            //
            $table->dropColumn('currency');
            $table->dropColumn('scholarship');
            $table->dropColumn('description');
        });
    }
};
