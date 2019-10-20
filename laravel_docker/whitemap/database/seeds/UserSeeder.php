<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'id' => 1,
            'firebase_uid' => 'system',
            'name' => 'システム管理者',
            'twitter_screen_name' => '',
            'twitter_profile_image_url_https' => '',
        ];
        DB::table('users')->insert($user);
        $user = [
            'id' => 2,
            'firebase_uid' => env('FIRST_USER_FIREBASE_UID'),
            'name' => env('FIRST_USER_NAME'),
            'twitter_screen_name' => env('FIRST_USER_TWITTER_SCREEN_NAME'),
            'twitter_profile_image_url_https' => env('FIRST_USER_TWITTER_PROFILE_IMAGE_URL'),
        ];
        DB::table('users')->insert($user);
    }
}
