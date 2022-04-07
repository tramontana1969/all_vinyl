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
                $table->string('description');
            });
        }
        else {
            Schema::create('vinyls', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->char('author', 64);
                $table->char('name', 64);
                $table->string('cover');
                $table->integer('price');
                $table->integer('year');
                $table->string('description');
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
        Schema::dropColumns('vinyls', ['author', 'name', 'cover', 'price', 'year', 'description']);
    }
}
