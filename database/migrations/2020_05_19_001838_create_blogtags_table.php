<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Settings\SettingsCommonsDatabase;

class CreateBlogtagsTable extends Migration
{
    public function up()
    {
        Schema::create('blogtags', function (Blueprint $table) {
            SettingsCommonsDatabase::addId($table);
            $table->unsignedInteger('tag_id')->nullable(false);
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
        Schema::dropIfExists('blogtags');
    }
}
