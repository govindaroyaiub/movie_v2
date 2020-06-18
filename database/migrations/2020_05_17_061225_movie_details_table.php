<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MovieDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_details', function (Blueprint $table) {
            $table->id();
            $table->string('movie_title')->nullable();
            $table->longText('movie_description_short')->nullable();
            $table->longText('movie_description_long')->nullable();
            $table->longText('buy_tickets')->nullable();
            $table->longText('movie_description_short_nl')->nullable();
            $table->longText('movie_description_long_nl')->nullable();
            $table->longText('buy_tickets_nl')->nullable();
            $table->date('cinema_date')->nullable();
            $table->string('director')->nullable();
            $table->longText('producer')->nullable();
            $table->longText('writer')->nullable();
            $table->longText('actors')->nullable();
            $table->longText('youtube_url')->nullable();
            $table->longText('image1')->nullable();
            $table->longText('image2')->nullable();
            $table->longText('image3')->nullable();
            $table->longText('duration')->nullable();
            $table->string('ratings')->nullable();
            $table->longText('base_url')->nullable();
            $table->longText('ticket_url')->nullable();
            $table->longText('fb_link')->nullable();
            $table->longText('twitter_link')->nullable();
            $table->string('hashtag')->nullable();
            $table->longText('cookies')->nullable();
            $table->longText('cookies_nl')->nullable();
            $table->longText('terms_of_use')->nullable();
            $table->longText('terms_of_use_nl')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('privacy_policy_nl')->nullable();
            $table->longText('credits')->nullable();
            $table->longText('credits_nl')->nullable();
            $table->longText('fb_pixel')->nullable();
            $table->longText('google_pixel')->nullable();
            $table->string('is_delete')->nullable();
            $table->string('uploaded_by')->nullable();
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
        Schema::dropIfExists('movie_details');
    }
}
