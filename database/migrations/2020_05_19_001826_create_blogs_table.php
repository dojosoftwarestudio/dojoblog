<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Settings\SettingsCommonsDatabase;


class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            SettingsCommonsDatabase::addId($table);
            $table->string('title',60);
            $table->text('post');
            $table->string('slug',100);
            $table->unsignedInteger('user_id')->nullable(false);
            $table->string('featureImage',SettingsCommonsDatabase::getDefaultLength());
            $table->string('metaDescription',160);
            $table->integer('views');
            $table->string('post_excerpt',400);
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
        Schema::dropIfExists('blogs');
    }
}
