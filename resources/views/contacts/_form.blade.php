@php
    $selectedFamilyId = old('family_id', $contact->family_id ?? '');
    $selectedRelationshipId = old('relationship_id', $contact->relationship_id ?? '');
    $oldPhoneNumbers = old('phone_numbers');

    if (is_array($oldPhoneNumbers)) {
        $phoneRows = $oldPhoneNumbers;
    } elseif ($contact && $contact->exists && $contact->phoneNumbers->isNotEmpty()) {
        $phoneRows = $contact->phoneNumbers
            ->mapWithKeys(fn ($phoneNumber) => [
                (string) $phoneNumber->id => [
                    'id' => $phoneNumber->id,
                    'label' => $phoneNumber->label,
                    'phone' => $phoneNumber->phone,
                    'is_primary' => $phoneNumber->is_primary,
                ],
            ])
            ->all();
    } else {
        $phoneRows = [
            'new_0' => [
                'id' => null,
                'label' => 'Mobile',
                'phone' => '',
                'is_primary' => true,
            ],
        ];
    }

    if ($phoneRows === []) {
        $phoneRows = [
            'new_0' => [
                'id' => null,
                'label' => 'Mobile',
                'phone' => '',
                'is_primary' => true,
            ],
        ];
    }

    $primaryPhoneKey = old('primary_phone_key');

    if ($primaryPhoneKey === null) {
        $primaryPhoneKey = array_key_first($phoneRows);

        foreach ($phoneRows as $key => $phoneRow) {
            if (! empty($phoneRow['is_primary'])) {
                $primaryPhoneKey = $key;
                break;
            }
        }
    }
@endphp

<div class="grid gap-5 md:grid-cols-2">
    <div>
        <x-input-label for="name" value="Name" />
        <x-text-input id="name" name="name" type="text" class="mt-2 block w-full" :value="old('name', $contact->name ?? '')" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="email" value="Email" />
        <x-text-input id="email" name="email" type="email" class="mt-2 block w-full" :value="old('email', $contact->email ?? '')" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="family_id" value="Family" />
        <select id="family_id" name="family_id" class="mt-2 block min-h-11 w-full rounded-lg border-slate-300 bg-white px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
            <option value="">Select family</option>
            @foreach ($families as $family)
                <option value="{{ $family->id }}" @selected((string) $selectedFamilyId === (string) $family->id)>
                    {{ $family->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('family_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="relationship_id" value="Relationship" />
        <select id="relationship_id" name="relationship_id" class="mt-2 block min-h-11 w-full rounded-lg border-slate-300 bg-white px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
            <option value="">Select relationship</option>
            @foreach ($relationships as $relationship)
                <option value="{{ $relationship->id }}" @selected((string) $selectedRelationshipId === (string) $relationship->id)>
                    {{ $relationship->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('relationship_id')" class="mt-2" />
    </div>
</div>

<div class="mt-5">
    <x-input-label for="address" value="Address" />
    <textarea id="address" name="address" rows="3" class="mt-2 block w-full rounded-lg border-slate-300 bg-white px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder-slate-500">{{ old('address', $contact->address ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('address')" class="mt-2" />
</div>

<div class="mt-6 border-t border-slate-200 pt-6 dark:border-slate-800">
    <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-base font-semibold text-slate-900 dark:text-slate-100">Phone numbers</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Add one or more phone numbers and choose the primary number.</p>
        </div>

        <button type="button" id="add-phone-number" class="inline-flex justify-center rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">
            Add Phone Number
        </button>
    </div>

    <x-input-error :messages="$errors->get('phone_numbers')" class="mt-3" />

    <div id="phone-numbers-list" class="mt-4 space-y-4">
        @foreach ($phoneRows as $key => $phoneRow)
            <div class="phone-number-row rounded-lg border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/60" data-phone-row>
                <input type="hidden" name="phone_numbers[{{ $key }}][id]" value="{{ $phoneRow['id'] ?? '' }}">

                <div class="grid gap-4 md:grid-cols-[1fr_1fr_auto] md:items-start">
                    <div>
                        <x-input-label for="phone-label-{{ $key }}" value="Label" />
                        <x-text-input id="phone-label-{{ $key }}" name="phone_numbers[{{ $key }}][label]" type="text" class="mt-2 block w-full" :value="$phoneRow['label'] ?? 'Mobile'" />
                        <x-input-error :messages="$errors->get('phone_numbers.' . $key . '.label')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="phone-number-{{ $key }}" value="Phone" />
                        <x-text-input id="phone-number-{{ $key }}" name="phone_numbers[{{ $key }}][phone]" type="text" class="mt-2 block w-full" :value="$phoneRow['phone'] ?? ''" required />
                        <x-input-error :messages="$errors->get('phone_numbers.' . $key . '.phone')" class="mt-2" />
                    </div>

                    <div class="flex gap-3 md:pt-8">
                        <label class="inline-flex items-center gap-2 text-sm font-medium text-slate-700 dark:text-slate-200">
                            <input type="radio" name="primary_phone_key" value="{{ $key }}" class="border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950" @checked((string) $primaryPhoneKey === (string) $key)>
                            Primary
                        </label>

                        <button type="button" class="remove-phone-number text-sm font-semibold text-red-600 hover:text-red-700 dark:text-red-300 dark:hover:text-red-200">
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const list = document.getElementById('phone-numbers-list');
        const addButton = document.getElementById('add-phone-number');

        if (!list || !addButton) {
            return;
        }

        const refreshRemoveButtons = () => {
            const rows = list.querySelectorAll('[data-phone-row]');

            rows.forEach((row) => {
                const removeButton = row.querySelector('.remove-phone-number');

                if (removeButton) {
                    removeButton.disabled = rows.length === 1;
                    removeButton.classList.toggle('opacity-40', rows.length === 1);
                    removeButton.classList.toggle('cursor-not-allowed', rows.length === 1);
                }
            });
        };

        const createPhoneRow = () => {
            const key = `new_${Date.now()}`;
            const wrapper = document.createElement('div');

            wrapper.className = 'phone-number-row rounded-lg border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950/60';
            wrapper.dataset.phoneRow = '';
            wrapper.innerHTML = `
                <input type="hidden" name="phone_numbers[${key}][id]" value="">

                <div class="grid gap-4 md:grid-cols-[1fr_1fr_auto] md:items-start">
                    <div>
                        <label for="phone-label-${key}" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Label</label>
                        <input id="phone-label-${key}" name="phone_numbers[${key}][label]" type="text" value="Mobile" class="mt-2 block min-h-11 w-full rounded-lg border-slate-300 bg-white px-3 py-2 text-base text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder-slate-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="phone-number-${key}" class="block text-sm font-medium text-slate-700 dark:text-slate-200">Phone</label>
                        <input id="phone-number-${key}" name="phone_numbers[${key}][phone]" type="text" required class="mt-2 block min-h-11 w-full rounded-lg border-slate-300 bg-white px-3 py-2 text-base text-slate-900 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100 dark:placeholder-slate-500 sm:text-sm">
                    </div>

                    <div class="flex gap-3 md:pt-8">
                        <label class="inline-flex items-center gap-2 text-sm font-medium text-slate-700 dark:text-slate-200">
                            <input type="radio" name="primary_phone_key" value="${key}" class="border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:border-slate-700 dark:bg-slate-950">
                            Primary
                        </label>

                        <button type="button" class="remove-phone-number text-sm font-semibold text-red-600 hover:text-red-700 dark:text-red-300 dark:hover:text-red-200">
                            Remove
                        </button>
                    </div>
                </div>
            `;

            return wrapper;
        };

        addButton.addEventListener('click', () => {
            list.appendChild(createPhoneRow());
            refreshRemoveButtons();
        });

        list.addEventListener('click', (event) => {
            if (!event.target.classList.contains('remove-phone-number')) {
                return;
            }

            const rows = list.querySelectorAll('[data-phone-row]');

            if (rows.length === 1) {
                return;
            }

            const row = event.target.closest('[data-phone-row]');
            const radio = row.querySelector('input[type="radio"]');
            const wasPrimary = radio && radio.checked;

            row.remove();

            if (wasPrimary) {
                const firstRadio = list.querySelector('input[type="radio"]');

                if (firstRadio) {
                    firstRadio.checked = true;
                }
            }

            refreshRemoveButtons();
        });

        refreshRemoveButtons();
    });
</script>
