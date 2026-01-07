<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kader;
use App\Models\Balita;
use App\Models\IbuHamil;
use App\Models\Lansia;
use App\Models\JadwalPosyandu;
use App\Models\CatatanKesehatan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Mengisi database dengan data awal untuk pengujian.
     */
    public function run(): void
    {
        // Membuat akun admin
        User::create([
            'name' => 'Admin Posyandu',
            'email' => 'admin@posyandu.com',
            'password' => Hash::make('password'),
        ]);

        // Membuat data Kader
        $kaderData = [
            ['nama' => 'Ibu Siti Aminah', 'alamat' => 'Jl. Melati No. 10, RT 01/RW 02', 'no_hp' => '081234567890', 'jabatan' => 'Ketua', 'tanggal_bergabung' => '2020-01-15', 'aktif' => true],
            ['nama' => 'Ibu Dewi Susanti', 'alamat' => 'Jl. Mawar No. 15, RT 02/RW 02', 'no_hp' => '081234567891', 'jabatan' => 'Sekretaris', 'tanggal_bergabung' => '2020-03-20', 'aktif' => true],
            ['nama' => 'Ibu Rina Wati', 'alamat' => 'Jl. Anggrek No. 5, RT 01/RW 03', 'no_hp' => '081234567892', 'jabatan' => 'Bendahara', 'tanggal_bergabung' => '2021-02-10', 'aktif' => true],
            ['nama' => 'Ibu Yuni Astuti', 'alamat' => 'Jl. Kenanga No. 8, RT 03/RW 01', 'no_hp' => '081234567893', 'jabatan' => 'Anggota', 'tanggal_bergabung' => '2022-05-01', 'aktif' => true],
        ];

        foreach ($kaderData as $kader) {
            Kader::create($kader);
        }

        // Membuat data Balita
        $balitaData = [
            ['nama' => 'Ahmad Fauzi', 'tanggal_lahir' => '2024-03-15', 'jenis_kelamin' => 'L', 'nama_ortu' => 'Bapak Fauzi', 'alamat' => 'Jl. Dahlia No. 1, RT 01/RW 01', 'berat_badan' => 10.5, 'tinggi_badan' => 75.0],
            ['nama' => 'Siti Fatimah', 'tanggal_lahir' => '2023-11-20', 'jenis_kelamin' => 'P', 'nama_ortu' => 'Ibu Fatimah', 'alamat' => 'Jl. Dahlia No. 3, RT 01/RW 01', 'berat_badan' => 12.0, 'tinggi_badan' => 80.5],
            ['nama' => 'Muhammad Rizki', 'tanggal_lahir' => '2024-06-10', 'jenis_kelamin' => 'L', 'nama_ortu' => 'Bapak Rizki', 'alamat' => 'Jl. Melati No. 7, RT 02/RW 01', 'berat_badan' => 8.0, 'tinggi_badan' => 65.0],
            ['nama' => 'Aisyah Putri', 'tanggal_lahir' => '2023-08-05', 'jenis_kelamin' => 'P', 'nama_ortu' => 'Ibu Putri', 'alamat' => 'Jl. Mawar No. 12, RT 02/RW 02', 'berat_badan' => 13.5, 'tinggi_badan' => 85.0],
        ];

        foreach ($balitaData as $balita) {
            Balita::create($balita);
        }

        // Membuat data Ibu Hamil
        $ibuHamilData = [
            ['nama' => 'Sri Wahyuni', 'tanggal_lahir' => '1995-05-20', 'alamat' => 'Jl. Anggrek No. 10, RT 01/RW 03', 'no_hp' => '081345678901', 'usia_kehamilan' => 28, 'hpl' => '2026-03-15', 'golongan_darah' => 'A', 'nama_suami' => 'Budi Santoso'],
            ['nama' => 'Ani Lestari', 'tanggal_lahir' => '1998-08-15', 'alamat' => 'Jl. Kenanga No. 5, RT 03/RW 01', 'no_hp' => '081345678902', 'usia_kehamilan' => 16, 'hpl' => '2026-06-20', 'golongan_darah' => 'B', 'nama_suami' => 'Dedi Kurniawan'],
            ['nama' => 'Rina Puspita', 'tanggal_lahir' => '1992-12-10', 'alamat' => 'Jl. Flamboyan No. 8, RT 02/RW 03', 'no_hp' => '081345678903', 'usia_kehamilan' => 35, 'hpl' => '2026-02-01', 'golongan_darah' => 'O', 'nama_suami' => 'Agus Hermawan'],
        ];

        foreach ($ibuHamilData as $ibuHamil) {
            IbuHamil::create($ibuHamil);
        }

        // Membuat data Lansia
        $lansiaData = [
            ['nama' => 'H. Abdul Rahman', 'tanggal_lahir' => '1955-03-10', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Melati No. 20, RT 01/RW 02', 'no_hp' => '081456789012', 'riwayat_penyakit' => 'Diabetes, Hipertensi', 'golongan_darah' => 'A'],
            ['nama' => 'Hj. Siti Khadijah', 'tanggal_lahir' => '1950-07-25', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Mawar No. 18, RT 02/RW 02', 'no_hp' => '081456789013', 'riwayat_penyakit' => 'Asam Urat', 'golongan_darah' => 'B'],
            ['nama' => 'Bpk. Sukarno', 'tanggal_lahir' => '1958-11-17', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Anggrek No. 15, RT 01/RW 03', 'no_hp' => '081456789014', 'riwayat_penyakit' => 'Jantung', 'golongan_darah' => 'O'],
        ];

        foreach ($lansiaData as $lansia) {
            Lansia::create($lansia);
        }

        // Membuat data Jadwal Posyandu
        $jadwalData = [
            ['tanggal' => '2026-01-10', 'waktu_mulai' => '08:00', 'waktu_selesai' => '12:00', 'lokasi' => 'Balai RW 02', 'kegiatan' => 'Penimbangan Balita', 'kader_id' => 1, 'status' => 'Dijadwalkan'],
            ['tanggal' => '2026-01-17', 'waktu_mulai' => '08:00', 'waktu_selesai' => '11:00', 'lokasi' => 'Puskesmas Kelurahan', 'kegiatan' => 'Pemeriksaan Ibu Hamil', 'kader_id' => 2, 'status' => 'Dijadwalkan'],
            ['tanggal' => '2026-01-24', 'waktu_mulai' => '09:00', 'waktu_selesai' => '12:00', 'lokasi' => 'Balai RW 03', 'kegiatan' => 'Pemeriksaan Lansia', 'kader_id' => 3, 'status' => 'Dijadwalkan'],
        ];

        foreach ($jadwalData as $jadwal) {
            JadwalPosyandu::create($jadwal);
        }

        // Membuat data Catatan Kesehatan untuk Balita
        $balita1 = Balita::first();
        CatatanKesehatan::create([
            'tanggal' => '2025-12-15',
            'catatan' => 'Balita dalam kondisi sehat, pertumbuhan normal sesuai usia.',
            'tindakan' => 'Pemberian vitamin A dan imunisasi campak.',
            'berat_badan' => 10.2,
            'tinggi_badan' => 74.5,
            'catatantable_type' => 'App\Models\Balita',
            'catatantable_id' => $balita1->id,
        ]);

        // Membuat data Catatan Kesehatan untuk Ibu Hamil
        $ibuHamil1 = IbuHamil::first();
        CatatanKesehatan::create([
            'tanggal' => '2025-12-20',
            'catatan' => 'Pemeriksaan rutin trimester 3, kondisi janin baik.',
            'tindakan' => 'Pemberian tablet Fe dan konseling nutrisi.',
            'tekanan_darah_sistol' => 120,
            'tekanan_darah_diastol' => 80,
            'berat_badan' => 65.5,
            'catatantable_type' => 'App\Models\IbuHamil',
            'catatantable_id' => $ibuHamil1->id,
        ]);

        // Membuat data Catatan Kesehatan untuk Lansia
        $lansia1 = Lansia::first();
        CatatanKesehatan::create([
            'tanggal' => '2025-12-22',
            'catatan' => 'Tekanan darah terkontrol, gula darah normal.',
            'tindakan' => 'Edukasi pola makan dan olahraga ringan.',
            'tekanan_darah_sistol' => 130,
            'tekanan_darah_diastol' => 85,
            'catatantable_type' => 'App\Models\Lansia',
            'catatantable_id' => $lansia1->id,
        ]);
    }
}
