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
            $table->text('title')->nullable()->after('url');
            $table->text('share_title')->nullable()->after('title');
            $table->longText('keywords')->nullable()->after('share_title');
            $table->string('page_image')->nullable()->after('keywords');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('share_title');
            $table->dropColumn('keywords');
            $table->dropColumn('page_image');
        });
    }
};
