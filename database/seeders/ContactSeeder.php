<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Family;
use App\Models\Relationship;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $family = Family::where('name', 'Main Family')->firstOrFail();

        $contacts = [
            [
                'name' => 'Dara',
                'relationship' => 'Father',
                'email' => 'dara@example.com',
                'address' => 'Phnom Penh',
            ],
            [
                'name' => 'Sophea',
                'relationship' => 'Mother',
                'email' => 'sophea@example.com',
                'address' => 'Phnom Penh',
            ],
            [
                'name' => 'Vireak',
                'relationship' => 'Brother',
                'email' => 'vireak@example.com',
                'address' => 'Siem Reap',
            ],
            [
                'name' => 'Nita',
                'relationship' => 'Sister',
                'email' => 'nita@example.com',
                'address' => 'Battambang',
            ],
        ];

        foreach ($contacts as $contact) {
            $relationship = Relationship::where('name', $contact['relationship'])->firstOrFail();

            Contact::create([
                'family_id' => $family->id,
                'relationship_id' => $relationship->id,
                'name' => $contact['name'],
                'email' => $contact['email'],
                'address' => $contact['address'],
            ]);
        }
    }
}
