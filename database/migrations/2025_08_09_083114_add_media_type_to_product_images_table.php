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
        Schema::table('product_images', function (Blueprint $table) {
            // Tambahkan kolom untuk tipe media setelah kolom 'image'
            $table->string('media_type')->default('image')->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('product_images', function (Blueprint $table) {
            $table->dropColumn('media_type');
        });
    }
};
