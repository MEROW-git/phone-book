<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Family;
use App\Models\PhoneNumber;
use Illuminate\View\View;

class PhoneBookController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::with(['family', 'relationship', 'phoneNumbers'])
            ->orderBy('name')
            ->get();

        return view('phonebook.index', [
            'contacts' => $contacts,
            'totalContacts' => Contact::count(),
            'totalFamilies' => Family::count(),
            'totalPhoneNumbers' => PhoneNumber::count(),
        ]);
    }
}
