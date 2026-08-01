<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lenders', function (Blueprint $table) {
            $table->foreignId('lender_detail_id')
                ->nullable()
                ->after('id')
                ->constrained('lender_details')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('lenders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('lender_detail_id');
        });
    }
};
