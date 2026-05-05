<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\PhoneNumber;
use Illuminate\Database\Seeder;

class PhoneNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phoneNumbers = [
            'Dara' => [
                ['label' => 'Mobile', 'phone' => '010123456', 'is_primary' => true],
                ['label' => 'Work', 'phone' => '023111222', 'is_primary' => false],
            ],
            'Sophea' => [
                ['label' => 'Mobile', 'phone' => '011222333', 'is_primary' => true],
            ],
            'Vireak' => [
                ['label' => 'Mobile', 'phone' => '012345678', 'is_primary' => true],
            ],
            'Nita' => [
                ['label' => 'Mobile', 'phone' => '015555999', 'is_primary' => true],
            ],
        ];

        foreach ($phoneNumbers as $contactName => $numbers) {
            $contact = Contact::where('name', $contactName)->firstOrFail();

            foreach ($numbers as $number) {
                PhoneNumber::create([
                    'contact_id' => $contact->id,
                    'label' => $number['label'],
                    'phone' => $number['phone'],
                    'is_primary' => $number['is_primary'],
                ]);
            }
        }
    }
}
