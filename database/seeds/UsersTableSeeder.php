<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=factory(User::class)->times (50)->make();
        User::insert($users->makeVisible(['password','remember_token'])->toArray());

        $user=User::find(1);
        $user->name = 'xiaopan92';
        $user->email = '757273952@qq.com';
        $user->password = bcrypt('757273952@qq.com');
        $user->is_admin = true;
        $user->save();

        $user=User::find(2);
        $user->name = 'xiaoqin92';
        $user->email = '852608654@qq.com';
        $user->password = bcrypt('852608654@qq.com');
        $user->is_admin = false;
        $user->save();
    }
}
