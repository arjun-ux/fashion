<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->unsignedBigInteger('kategori_id'); // Foreign key untuk tabel kategori
            $table->string('gambar')->nullable();
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('kategori_id')
                  ->references('id')
                  ->on('kategoris')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
