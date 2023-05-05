<?php

use Illuminate\Database\Seeder;
use App\Models\Follow;

class FollowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 2; $i <= 10; $i++) {
            DB::table('follows')->insert([
                'following_id' => $i,
                'followed_id' => 1
            ]);
        }
        //DB::table('follows')->insert([
          //  [
            //    'followed_id' => 'あいう',
          //],
            //[
              //  'followed_id' => ' さしす',
          //],
        //]);
    }
}
