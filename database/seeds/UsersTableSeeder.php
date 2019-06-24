<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Docente',
            'email' => 'docente@gmail.com',
            'username' => 'docente',
            'role' => 'ADMIN',
            'password' => bcrypt('docente@123*#'),
        ]);

        DB::table('users')->insert([
            'name' => 'Estudiante de prueba',
            'email' => 'studen@gmail.com',
            'username' => 'prueba',
            'role' => 'USER',
            'password' => bcrypt('prueba'),
        ]);
    }
}
