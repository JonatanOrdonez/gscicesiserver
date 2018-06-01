<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nombres = [
            0 => "salasclient",
            1 => "angularclient",
            2 => "administrador"
        ];
        $emails = [
            0 => "salasclient@correo.icesi.edu.co",
            1 => "angularclient@correo.icesi.edu.co",
            2 => "administrador@correo.icesi.edu.co"
        ];
        $api_tokens = [
            0 => 'tnrApcPohoar9padK6JTEY3Z8mm7OkzkyLYUXgzjnJbqOg3DT1tOIuhQKBfM',
            1 => '$2y$10$X0yixpWjRsiSkQyK6SoCN.dvmYVBWK9b9uTSOmpXws8ITpYr9y.yO',
            2 => 'E3i3UkYkCo6G0GT7Cf7Dlnj4ql8RPSVEPJgZTnUm11CJ4L5dERCb3qLHKkzL'
        ];
        $passwords = [
            0 => 'salasclient',
            1 => 'angularclient',
            2 => 'administrador'
        ];
        $cantidad = 3;
        for ($i = 0; $i < $cantidad; $i++) {
            DB::table('users')->insert([
                'name' => $nombres[$i],
                'email' => $emails[$i],
                'api_token' => $api_tokens[$i],
                'password' => $passwords[$i],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }
    }
}
