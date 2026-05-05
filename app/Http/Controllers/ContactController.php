<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Family;
use App\Models\PhoneNumber;
use App\Models\Relationship;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::with(['family', 'relationship', 'phoneNumbers'])
            ->orderBy('name')
            ->get();

        return view('contacts.index', [
            'contacts' => $contacts,
            'totalContacts' => Contact::count(),
            'totalFamilies' => Family::count(),
            'totalPhoneNumbers' => PhoneNumber::count(),
        ]);
    }

    public function create(): View
    {
        return view('contacts.create', [
            'contact' => null,
            'families' => Family::orderBy('name')->get(),
            'relationships' => Relationship::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateContact($request);

        $contact = Contact::create([
            'family_id' => $validated['family_id'],
            'relationship_id' => $validated['relationship_id'],
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        $this->syncPhoneNumbers($request, $contact, $validated['phone_numbers']);

        return redirect()
            ->route('contacts.index')
            ->with('status', 'Contact created.');
    }

    public function edit(Contact $contact): View
    {
        $contact->load(['family', 'relationship', 'phoneNumbers']);

        return view('contacts.edit', [
            'contact' => $contact,
            'families' => Family::orderBy('name')->get(),
            'relationships' => Relationship::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Contact $contact): RedirectResponse
    {
        $validated = $this->validateContact($request);

        $contact->update([
            'family_id' => $validated['family_id'],
            'relationship_id' => $validated['relationship_id'],
            'name' => $validated['name'],
            'email' => $validated['email'] ?? null,
            'address' => $validated['address'] ?? null,
        ]);

        $this->syncPhoneNumbers($request, $contact, $validated['phone_numbers']);

        return redirect()
            ->route('contacts.index')
            ->with('status', 'Contact updated.');
    }

    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()
            ->route('contacts.index')
            ->with('status', 'Contact deleted.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateContact(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'family_id' => ['required', 'exists:families,id'],
            'relationship_id' => ['required', 'exists:relationships,id'],
            'email' => ['nullable', 'email'],
            'address' => ['nullable', 'string'],
            'phone_numbers' => ['required', 'array', 'min:1'],
            'phone_numbers.*.id' => ['nullable', 'integer'],
            'phone_numbers.*.label' => ['nullable', 'string', 'max:50'],
            'phone_numbers.*.phone' => ['required', 'string', 'max:30'],
            'primary_phone_key' => ['nullable', 'string'],
        ]);
    }

    /**
     * @param array<string, array<string, mixed>> $phoneNumbers
     */
    private function syncPhoneNumbers(Request $request, Contact $contact, array $phoneNumbers): void
    {
        $primaryKey = $request->string('primary_phone_key')->toString();
        $existingIds = $contact->phoneNumbers()->pluck('id')->map(fn (int $id): string => (string) $id);
        $savedIds = [];

        if ($primaryKey === '' || ! array_key_exists($primaryKey, $phoneNumbers)) {
            $primaryKey = array_key_first($phoneNumbers);
        }

        foreach ($phoneNumbers as $key => $phoneNumber) {
            $id = isset($phoneNumber['id']) ? (string) $phoneNumber['id'] : null;
            $payload = [
                'label' => $phoneNumber['label'] ?: 'Mobile',
                'phone' => $phoneNumber['phone'],
                'is_primary' => (string) $key === (string) $primaryKey,
            ];

            if ($id && $existingIds->contains($id)) {
                $contact->phoneNumbers()->whereKey($id)->update($payload);
                $savedIds[] = $id;

                continue;
            }

            $created = $contact->phoneNumbers()->create($payload);
            $savedIds[] = (string) $created->id;
        }

        $contact->phoneNumbers()
            ->when($savedIds !== [], fn ($query) => $query->whereNotIn('id', $savedIds))
            ->delete();
    }
}
