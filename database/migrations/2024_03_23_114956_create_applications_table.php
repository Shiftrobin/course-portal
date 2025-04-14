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
        Schema::create('applications', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->text('name');
			$table->string('nationality');
			$table->string('phone');
			$table->text('address')->nullable();
			$table->string('email');
			$table->text('qualification')->nullable();
			$table->string('cv')->nullable();
			$table->string('sop')->nullable();
			$table->string('passport')->nullable();
			$table->string('ielts')->nullable();
			$table->string('transcript')->nullable();
			$table->string('certificate')->nullable();
			$table->longText('msg')->nullable();
			$table->text('course');
			$table->text('university');
			$table->string('campus');
            $table->integer('status')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
