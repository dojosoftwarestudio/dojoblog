<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Settings\SettingsCommonsDatabase;
class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            SettingsCommonsDatabase::addId($table);
            $table->string('fullName', SettingsCommonsDatabase::getDefaultLength());
            $table->string('email')->unique();
            $table->string('password',SettingsCommonsDatabase::getDefaultLength())->nullable('false');
            $table->string('userType',SettingsCommonsDatabase::getDefaultLength())->default('user');
            $table->boolean('isActivated')->default(0);
            $table->string('passwordResetCode', SettingsCommonsDatabase::getDefaultLength())->nullable();
            $table->string('activationCode', SettingsCommonsDatabase::getDefaultLength())->nullable();
            $table->string('socialType',25)->nullable();
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
        Schema::dropIfExists('users');
    }
}
