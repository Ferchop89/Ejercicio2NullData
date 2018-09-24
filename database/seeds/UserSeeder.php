<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       $this->createUser("cliente", "cliente@test.com", "123456");
     }
     public function createUser($name, $email, $password)
     {
       $alumno = new User();
       $alumno->name = $name;
       $alumno->email = $email;
       $alumno->password = bcrypt($password);
       $alumno->save();
    }
}
