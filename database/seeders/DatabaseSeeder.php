<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder {
    public function run(): void {
        $email=env('BLOOMCRAFT_ADMIN_EMAIL','admin@bloomcraft.local');
        $password=env('BLOOMCRAFT_ADMIN_PASSWORD');
        if (!$password || strlen($password)<12) {
            $this->command?->warn('Akun admin tidak dibuat: atur BLOOMCRAFT_ADMIN_PASSWORD (minimal 12 karakter) di .env lalu jalankan php artisan db:seed.');
        } else {
            User::updateOrCreate(['email'=>$email],['name'=>'Admin Bloomcraft','password'=>Hash::make($password),'role'=>'admin']);
        }
        $this->call([CategorySeeder::class,ProductSeeder::class]);
    }
}
