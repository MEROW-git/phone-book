<?php

namespace Database\Seeders;

use App\Models\Relationship;
use Illuminate\Database\Seeder;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (['Father', 'Mother', 'Brother', 'Sister'] as $name) {
            Relationship::create([
                'name' => $name,
            ]);
        }
    }
}
