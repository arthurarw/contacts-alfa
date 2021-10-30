<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => 'index'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'DESC')->paginate(5);

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
        $contact = Contact::where('id', $id)->first();
        if (empty($contact)) {
            return redirect()->route('contacts.index')
                ->withErrors('Contact not found.');
        }

        return view('contacts.show', [
            'contact' => $contact
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::where('id', $id)->first();
        if (empty($contact)) {
            return redirect()->route('contacts.index')
                ->withErrors('Contact not found.');
        }

        return view('contacts.forms.form', [
            'contact' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreContactRequest $request, $id)
    {
        $contact = Contact::where('id', $id)->first();
        if (empty($contact)) {
            return redirect()->route('contacts.index')
                ->withErrors('Contact not found.');
        }

        $request->validated();

        $contact->update($request->all());
        return redirect()->route('contacts.index')
            ->with('success', 'Contact updated successfully.');
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

        $contact->deleted_by = auth()->user()->id;
        $contact->deleted_at = date('Y-m-d H:i:s');
        $contact->save();
        return response()->json(['message' => 'The contact has been deleted.', 'success' => true]);
    }
}
