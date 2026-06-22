<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hotel')->insert([
            ['nama_hotel'=>'Hotel Mekkah','kota'=>'Mekkah','kategori_hotel'=>'Bintang 4','created_at'=>now(),'updated_at'=>now()],
            ['nama_hotel'=>'Hotel Madinah','kota'=>'Madinah','kategori_hotel'=>'Bintang 3','created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
