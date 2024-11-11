<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return response()->json([
            'message' => 'Liste des Utilisateur récupérée avec succès!',
            'items' => $items
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'age' => 'required|integer',
            'email' => 'required|email|unique:items,email',
            'telephone' => 'required',
        ]);

        $item = Item::create($request->all());

        return response()->json([
            'message' => 'Utilisateur créé avec succès!',
            'item' => $item
        ]);
    }

    public function show($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'message' => 'Utilisateur non trouvé'
            ], 404);
        }

        return response()->json([
            'message' => 'Utilisateur récupéré avec succès!',
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'message' => 'Utilisateur non trouvé'
            ], 404);
        }

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'age' => 'required|integer',
            'email' => 'required|email|unique:items,email,' . $id,
            'telephone' => 'required',
        ]);

        $item->update($request->all());

        return response()->json([
            'message' => 'Utilisateur mis à jour avec succès!',
            'item' => $item
        ]);
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return response()->json([
                'message' => 'Utilisateur non trouvé'
            ], 404);
        }

        $item->delete();

        return response()->json([
            'message' => 'Utilisateur supprimé avec succès!'
        ]);
    }
}
