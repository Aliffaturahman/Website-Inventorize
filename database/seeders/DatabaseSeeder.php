<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Kain;
use App\Models\Berat;
use App\Models\Kertas;
use App\Models\Produksi;
use App\Models\Roll;
use App\Models\StokKain;
use App\Models\StokKertas;
use App\Models\Tinta;
use App\Models\Transaksi;
use App\Models\Volume;
use App\Models\Warna;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Berat::factory(10)->create();
        Kain::factory(10)->create();
        Kertas::factory(10)->create();
        Produksi::factory(10)->create();
        Volume::factory(10)->create();
        Warna::factory(10)->create();
        Tinta::factory(10)->create();
        StokKain::factory(10)->create();
        Roll::factory(30)->create();
        StokKertas::factory(10)->create();
        Transaksi::factory(10)->create();
        $this->call([
            AdminSeeder::class,
        ]);
    }
}
