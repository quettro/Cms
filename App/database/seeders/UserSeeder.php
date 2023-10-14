<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        $user = new User();
        $user->email = 'username@bk.ru';
        $user->email_verified_at = now();
        $user->password = Hash::make('password');
        $user->name = 'username';
        $user->save();
        $user->givePermissionTo(Permission::query()->pluck('name')->toArray());
    }
}
