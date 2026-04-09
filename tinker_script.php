<?php
$admin = App\Models\User::firstOrCreate(['email' => 'admin@gmail.com'], ['name' => 'Admin PWF', 'password' => bcrypt('password')]);
$admin->role = 'admin';
$admin->save();

$user = App\Models\User::firstOrCreate(['email' => 'user@gmail.com'], ['name' => 'User Biasa', 'password' => bcrypt('password')]);
$user->role = 'user';
$user->save();

echo "BERHASIL\n";
