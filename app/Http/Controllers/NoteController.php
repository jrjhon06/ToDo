<?php

namespace App\Http\Controllers;

use App\Models\Note; // Asegúrate de importar el modelo Note
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function store(Request $request)
    {
        // Validación de los datos de la solicitud
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tags' => 'nullable|string',
            'due_date' => 'nullable|date',
            'image' => 'nullable|image|max:2048'
        ]);

        // Creación de la nueva nota
        $note = new Note();
        $note->title = $request->title;
        $note->description = $request->description;
        $note->tags = $request->tags;
        $note->due_date = $request->due_date;
        $note->user_id = auth();  // Asigna el usuario autenticado

        // Manejo de la imagen si existe en la solicitud
        if ($request->hasFile('image')) {
            $note->image = $request->file('image')->store('images', 'public');
        }

        // Guardar la nota en la base de datos
        $note->save();

        // Respuesta JSON con la nota creada
        return response()->json([
            'message' => 'Nota creada correctamente',
            'note' => $note
        ]);
    }

    public function index()
    {
        $notes = auth()('created_at', 'desc')->get();
        return response()->json($notes);
    }

    // Otros métodos (show, update, destroy) se pueden añadir aquí
}
