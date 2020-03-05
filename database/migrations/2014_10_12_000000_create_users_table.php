<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->string('api_token', 80)->unique()->nullable();
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
        $user = new User([
            'name' => 'Chris Kankiewicz',
            'email' => 'Chris@ChrisKankiewicz.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make(
                config('app.env') == 'local' ? 'secret' : Str::random(32)
            ),
            'api_token' => config('app.env') == 'local' ? 'TEST_TOKEN_PLEASE_IGNORE' : Str::random(60)
        ]);

        $user->is_admin = true;

        $user->save();
    }
}
