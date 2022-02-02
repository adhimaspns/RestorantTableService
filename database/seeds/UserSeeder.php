<?php

use Carbon\Carbon;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user   = [

            //! Kasir
            [
                'nama'          => "Adhimas Putra Nugraha Sugianto",
                'alamat'        => "Dsn. Mlaten Ds. Mlaten RT 01 RW 02",
                'jns_kelamin'   => "Laki-laki",
                'no_telp'       => "08970898910",
                'username'      => "kasir_adhimas",
                'password'      => bcrypt('kasir123'),
                'status'        => "Aktif",
                'level'         => "Kasir",
                'created_at'    => Carbon::now()
            ],

            //! Customer
            [
                'nama'          => "Mustawi",
                'alamat'        => "Dsn. Sambiroto Ds. Mlaten RT 03 RW 05",
                'jns_kelamin'   => "Laki-laki",
                'no_telp'       => "081615227898",
                'username'      => "mustawi",
                'password'      => bcrypt('mustawi123'),
                'status'        => "Aktif",
                'level'         => "Customer",
                'created_at'    => Carbon::now()
            ] 
        ];

        //! Seeding Data
        User::insert($user); 
    }
}
