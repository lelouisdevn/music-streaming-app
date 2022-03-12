<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSong extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('song', function (Blueprint $table) {
            $table->bigIncrements('SongId');
            $table->integer('AlbumId');
            $table->string('SongName');
            $table->string('SongArtist');
            $table->string('SongLyrics');
            $table->string('SongSource');
            $table->integer('SongStream');
            $table->string('SongCover');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('song');
    }
}
