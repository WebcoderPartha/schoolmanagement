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
        Schema::table('admins', function (Blueprint $table) {
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->text('gender')->nullable();
            $table->string('religion')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('designation_id')->nullable();
            $table->string('id_number')->nullable();
            $table->string('code')->nullable();
            $table->date('joining_date')->nullable();
            $table->double('salary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
            //
        });
    }
};
