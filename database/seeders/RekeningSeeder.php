<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RekeningSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rekening')->insert([
            ['nama_bank'=>'BCA','nomor_rekening'=>'1234567890','atas_nama'=>'PT Contoh','status'=>'Aktif','created_at'=>now(),'updated_at'=>now()],
            ['nama_bank'=>'Mandiri','nomor_rekening'=>'9876543210','atas_nama'=>'PT Contoh','status'=>'Aktif','created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
