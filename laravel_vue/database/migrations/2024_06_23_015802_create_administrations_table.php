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
        Schema::create('administrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_group_id')->constrained();
            $table->string('fullName');
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();
            $table->longText('image')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrations');
    }
};
