<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('perfumes', function (Blueprint $table) {
            $table->string('audience')->default('unisex')->after('brand');
        });
    }

    public function down(): void
    {
        Schema::table('perfumes', function (Blueprint $table) {
            $table->dropColumn('audience');
        });
    }
};
