<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('export-product', function (User $user) {
            return $user->role === 'admin';
        });

        // UCP 1 Penjelasan Detail:
        // 1. Gate::define(...) : Membuat sebuah aturan pembatasan hak akses kustom yang kita namakan 'manage-category'.
        // 2. function (User $user) : Secara sistematis menerima data objek dari akun user yang saat ini sedang login di browser.
        Gate::define('manage-category', function (User $user) {
            // UCP 1 Penjelasan Detail:
            // 1. $user->role === 'admin' : Kode ini mengevaluasi (mengecek) apakah nilai yang ada di kolom 'role' milik user yang login tersebut bernilai sama persis dengan teks 'admin'.
            // 2. return ... : Jika evaluasinya Benar (True), sistem memberi lampu hijau (izin akses rute/tampilan). Jika Salah (False), akses digagalkan.
            return $user->role === 'admin'; 
        });
    }
}
