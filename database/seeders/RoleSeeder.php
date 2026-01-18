<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'slug' => 'superadmin',
                'description' => 'Akses penuh ke semua fitur sistem',
                'level' => 100,
            ],
            [
                'name' => 'Leader',
                'slug' => 'leader',
                'description' => 'Penanggung jawab aset, dapat menambah dan mengelola aset yang ditugaskan',
                'level' => 75,
            ],
            [
                'name' => 'Admin',
                'slug' => 'admin',
                'description' => 'Akses untuk mengelola aset dan pengguna',
                'level' => 50,
            ],
            [
                'name' => 'User',
                'slug' => 'user',
                'description' => 'Akses dasar untuk melihat dan menggunakan aset',
                'level' => 10,
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['slug' => $role['slug']],
                $role
            );
        }
    }
}
