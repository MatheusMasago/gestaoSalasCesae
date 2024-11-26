<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // Verifica se há locais cadastrados antes de tentar associar um id_local
        $localIds = DB::table('locals')->pluck('id')->toArray();
        
        if (empty($localIds)) {
            $this->command->info('No locals found, seeder skipped.');
            return;
        }

        // Dados fictícios para popular a tabela 'rooms'
        $rooms = [
            ['name' => 'Room 101', 'capacity' => 20, 'id_local' => $localIds[array_rand($localIds)]],
            ['name' => 'Room 102', 'capacity' => 25, 'id_local' => $localIds[array_rand($localIds)]],
            ['name' => 'Room 201', 'capacity' => 30, 'id_local' => $localIds[array_rand($localIds)]],
            ['name' => 'Room 202', 'capacity' => 15, 'id_local' => $localIds[array_rand($localIds)]],
            ['name' => 'Room 301', 'capacity' => 50, 'id_local' => $localIds[array_rand($localIds)]],
            ['name' => 'Room 302', 'capacity' => 40, 'id_local' => $localIds[array_rand($localIds)]],
        ];

        // Inserir os dados na tabela 'rooms'
        DB::table('rooms')->insert($rooms);

        $this->command->info('Rooms table seeded successfully!');
    }
}
