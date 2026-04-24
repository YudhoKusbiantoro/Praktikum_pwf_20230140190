<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use App\Models\User;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

if (!Schema::hasColumn('users', 'role')) {
    Schema::table('users', function (Blueprint $table) {
        $table->string('role')->default('user');
    });
    echo "Kolom 'role' berhasil ditambahkan ke tabel users.\n";
} else {
    echo "Kolom 'role' sudah ada.\n";
}

$admin = User::where('name', 'Admin PWF')->first();
if ($admin) {
    $admin->role = 'admin';
    $admin->save();
    echo "Role Admin PWF berhasil diupdate menjadi admin.\n";
} else {
    echo "User 'Admin PWF' tidak ditemukan.\n";
}
