<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Setting::create();

        $akun = array(
            [
                'kode' => 1,
                'nama' => 'BANK BRI', 
                'keterangan' => 'masuk'
            ],
            [
                'kode' => 1,
                'nama' => 'BANK BRI', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 2,
                'nama' => 'SHU Sosial', 
                'keterangan' => 'masuk'
            ],
            [
                'kode' => 2,
                'nama' => 'Sosial', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 3,
                'nama' => 'SHU Cadangan', 
                'keterangan' => 'masuk'
            ],
            [
                'kode' => 3,
                'nama' => 'Cadangan', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 4,
                'nama' => 'Perahu Waluya', 
                'keterangan' => 'masuk'
            ],
            [
                'kode' => 5,
                'nama' => 'Persentase Bonus', 
                'keterangan' => 'masuk'
            ],
            [
                'kode' => 6,
                'nama' => 'Pelampung', 
                'keterangan' => 'masuk'
            ],
            [
                'kode' => 7,
                'nama' => 'Manasuka Perahu', 
                'keterangan' => 'masuk'
            ],
            [
                'kode' => 8,
                'nama' => 'Pengembalian Uang Duduk & Makan', 
                'keterangan' => 'masuk'
            ],
            [
                'kode' => 9,
                'nama' => 'Oprasional', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 10,
                'nama' => 'ADM/ATK', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 11,
                'nama' => 'ITUP', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 12,
                'nama' => 'IUAP', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 13,
                'nama' => 'PASS KECIL', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 14,
                'nama' => 'Honor Pengurus', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 15,
                'nama' => 'Honor Pengawas', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 16,
                'nama' => 'THR Pengurus', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 17,
                'nama' => 'THR Pengawas', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 18,
                'nama' => 'THR Anggota', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 19,
                'nama' => 'RAT', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 20,
                'nama' => 'SHU', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 21,
                'nama' => 'Beban Perahu Waluya', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 22,
                'nama' => 'Pra RAT', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 23,
                'nama' => 'PHBI', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 24,
                'nama' => 'Inventaris Perahu', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 25,
                'nama' => 'Pelatihan', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 26,
                'nama' => 'Cindera Mata', 
                'keterangan' => 'keluar'
            ],
            [
                'kode' => 27,
                'nama' => 'Door Prize', 
                'keterangan' => 'keluar'
            ]
        );
        App\Akun::insert($akun);
    }
}


