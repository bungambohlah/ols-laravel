<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // seeding pajak
        DB::table('pajak')->insert([
            'nama' => 'pph',
            'rate' => 0.05,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('pajak')->insert([
            'nama' => 'pajak toko',
            'rate' => 0.10,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // seeding item
        DB::table('item')->insert([
            'nama' => 'baju batik',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $pajaks = DB::table('pajak')->get();
        $items = DB::table('item')->first();
        $pajaks->each(function ($pajak) use ($items) {
            DB::table('pajakitem')->insert([
                'pajak_id' => $pajak->id,
                'item_id' => $items->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });
    }
}
