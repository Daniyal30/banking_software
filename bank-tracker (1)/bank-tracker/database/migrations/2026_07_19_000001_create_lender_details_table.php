<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lender_details', function (Blueprint $table) {
            $table->id();
            $table->string('cnic')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->string('relationship')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lender_details');
    }
};
