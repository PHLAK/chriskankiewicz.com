<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        $this->seed();
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

    /**
     * Seed the users table.
     *
     * @return void
     */
    protected function seed()
    {
        User::create([
            'name' => 'Chris Kankiewicz',
            'email' => 'Chris@ChrisKankiewicz.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make(
                config('app.env') == 'local' ? 'secret' : Str::random(32)
            ),
            'admin' => true
        ]);
    }
}
