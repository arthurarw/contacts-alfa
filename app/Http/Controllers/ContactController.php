<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::latest()->paginate(5);

        return view('contacts.index', [
            'data' => $contacts
        ])->with('i', (\request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.forms.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactRequest $request)
    {
        $request->validated();

        /*$validateUnique = Contact::where('email', $request->input('email'))->orWhere('contact', $request->input('contact'))->exists();
        if ($validateUnique) {
            return redirect()->route('contacts.create')
                ->withErrors('The email address or contact already exists.');
        }*/

        Contact::create($request->all());
        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
//        $contact

        return view('contacts.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::where('id', $id)->first();
        if (empty($contact)) {
            return response()->json(['message' => 'User not found', 'success' => false], 404);
        }

        $contact->delete();
        return response()->json(['message' => 'The contact has been deleted.', 'success' => true]);
    }
}
