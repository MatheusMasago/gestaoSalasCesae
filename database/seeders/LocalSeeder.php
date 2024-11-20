<?php

namespace Database\Seeders;

use App\Models\Local;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocalSeeder extends Seeder
{

    public function run(): void
    {
        // Criando locais padrão na DB
        foreach (Local::LOCALS as $local) {
            Local::create(['name' => $local]);
        }
    }
}
