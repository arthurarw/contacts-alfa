<?php

namespace App\Observers;

use App\Models\Contact;

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
        $contact->created_by = auth()->user()->id;
    }

    /**
     * Handle the Contact "updated" event.
     *
     * @param  \App\Models\Contact  $contact
     * @return void
     */
    public function updating(Contact $contact)
    {
        $contact->updated_by = auth()->user()->id;
    }
}
