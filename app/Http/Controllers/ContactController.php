<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::orderByDesc('created_at')->get();

        return view('contacts.index', [
            'contacts' => $contacts
        ]);
    }


    public function create()
    {
        return view('contacts.create');
    }


    protected function formatAndCleanPhone(string $phone)
    {
        $cleanedPhone = preg_replace('/[^\d+]/', '', $phone);
        return $cleanedPhone;
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // El formato que la librería de teléfono envía es generalmente: +XX NNNNN... (con espacios, sin paréntesis)

        $request->validate([
            'name' => 'required|string|max:100',
            // NUEVO REGEX: Permite + seguido de dígitos y espacios, que coincide con el input real.
            'phone' => 'required|string|max:20|regex:/^\+\d+[\d\s]*$/|unique:contacts',
            'email' => 'required|email|unique:contacts',
            'birthday' => 'nullable|date',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['phone'] = $this->formatAndCleanPhone($request->input('phone'));
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $photoPath;
        }

        Contact::create($data);
        return redirect()->route('contacts.index')
            ->with('success', 'contacto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = Contact::findOrFail($id);

        return view('contacts.edit', [
            'contact' => $contact
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:100',
            // REGEX ajustado y UNIQUE ignorando el ID actual
            'phone' => 'required|string|max:20|regex:/^\+\d+[\d\s]*$/|unique:contacts,phone,' . $id,
            // UNIQUE del email también ignora el ID actual
            'email' => 'required|email|unique:contacts,email,' . $id,
            'birthday' => 'nullable|date',
            'photo' => 'nullable|image|max:2048',
        ]);

        $contact = Contact::findOrFail($id);

        // TOMA todos los datos del request, EXCEPTO 'photo'.
        $data = $request->except(['photo']);
        $data['phone'] = $this->formatAndCleanPhone($request->input('phone'));

        // 1. Manejo de la foto
        if ($request->hasFile('photo')) {

            // 2. Si hay foto anterior, la elimina del disco
            if ($contact->photo) {
                Storage::disk('public')->delete($contact->photo);
            }

            // 3. Guarda la nueva foto y la asigna a $data
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $photoPath;
        }

        $contact->update($data);

        return redirect()->route('contacts.index')
            ->with('succes', 'Contacto actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $contact = Contact::findOrFail($id);

        // Elimina la foto del disco si existe
        if ($contact->photo) {
            Storage::disk('public')->delete($contact->photo);
        }

        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contacto eliminado correctamente.');
    }
}
