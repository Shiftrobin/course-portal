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
            $table->longText('overview')->nullable()->after('description');
            $table->longText('entry_requirements')->nullable()->after('overview');
            $table->longText('scholarship_details')->nullable()->after('entry_requirements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            //
            $table->dropColumn('overview');
            $table->dropColumn('entry_requirements');
            $table->dropColumn('scholarship_details');
        });
    }
};
