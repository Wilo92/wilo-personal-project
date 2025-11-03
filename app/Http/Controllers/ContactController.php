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
        $contacts = Contact::all();

        return view('contacts.index', [
            'contacts' => $contacts
        ]);
    }


    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:contacts',
            'birthday' => 'nullable|date',
            'photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $photoPath;
        }

        Contact::create($data);
        return redirect()->route('contacts.index')
            ->with('success', 'contact create');
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
    // Método Update CORREGIDO (solo mostraré la parte modificada)



    // ...

    public function update(Request $request, string $id)
    {
        // ... (Validación es correcta) ...

        $contact = Contact::findOrFail($id);

        // TOMA todos los datos del request, EXCEPTO 'photo' para evitar que se pase 
        // un campo vacío si no se subió un archivo.
        $data = $request->except(['photo']);

        // 1. Manejo de la foto
        if ($request->hasFile('photo')) {

            // 2. Si hay foto anterior, la elimina del disco
            if ($contact->photo) {
                Storage::disk('public')->delete($contact->photo);
            }

            // 3. Guarda la nueva foto y la asigna a $data
            $photoPath = $request->file('photo')->store('photos', 'public');
            $data['photo'] = $photoPath; // <--- Solo se asigna la ruta si se subió una nueva
        }
        // 4. Si el usuario subió el formulario sin archivo, $data NO contiene 'photo', 
        //    por lo que no se actualiza la ruta existente. 
        //    Si quieres permitir al usuario eliminar la foto sin subir una nueva, 
        //    necesitas un checkbox en la vista (ver nota abajo).

        $contact->update($data);

        return redirect()->route('contacts.index')
            ->with('succes', 'bien bien');
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
