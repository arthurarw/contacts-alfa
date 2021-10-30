<?php

namespace App\Observers;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactObserver
{
    /**
     * Handle the Contact "created" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function creating(Contact $contact)
    {
        if (Auth::check()) {
            $contact->created_by = auth()->user()->id;
        }
    }

    /**
     * Handle the Contact "updated" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function updating(Contact $contact)
    {
        if (Auth::check()) {
            $contact->updated_by = auth()->user()->id;
        }
    }
}
