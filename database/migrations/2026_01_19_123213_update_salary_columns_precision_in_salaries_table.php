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
        Schema::table('salaries', function (Blueprint $table) {
                        // 15 total digits, 2 after decimal point (Allows up to 9,999,999,999,999.99)
            $table->decimal('basic_salary', 15, 2)->change();
            $table->decimal('net_salary', 15, 2)->change();
            
            // Do the same for allowance and deductions to be safe
            $table->decimal('allowance', 15, 2)->nullable()->change();
            $table->decimal('deductions', 15, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salaries', function (Blueprint $table) {
               // Revert back to default (if needed, though usually not recommended to go smaller)
            $table->decimal('basic_salary', 8, 2)->change();
            $table->decimal('net_salary', 8, 2)->change();
            $table->decimal('allowance', 8, 2)->nullable()->change();
            $table->decimal('deductions', 8, 2)->nullable()->change();
        });
    }
};
