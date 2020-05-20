<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Settings\SettingsCommonsDatabase;

class CreateBlogcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogcategories', function (Blueprint $table) {
            SettingsCommonsDatabase::addId($table);
            $table->unsignedInteger('category_id')->nullable(false);
            $table->unsignedInteger('blog_id')->nullable(false);
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
        Schema::dropIfExists('blogcategories');
    }
}
