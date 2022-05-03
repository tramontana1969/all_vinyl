<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVinylsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('vinyls')) {
            Schema::table('vinyls', function (Blueprint $table) {
                $table->char('author', 64);
                $table->char('name', 64);
                $table->string('cover');
                $table->integer('price');
                $table->integer('year');
                $table->longText('description');
                $table->integer('quantity');
            });
        }
        else {
            Schema::create('vinyls', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->char('author', 64);
                $table->char('name', 64);
                $table->string('cover');
                $table->float('price');
                $table->integer('year');
                $table->longText('description');
                $table->integer('quantity');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vinyls');
    }
}
