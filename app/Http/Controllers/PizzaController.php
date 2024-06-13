<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;


class PizzaController extends Controller
{
    //
    public function create_pizza(Request $request)
    {
        $request->validate([
            'flavour' => 'required|string',
            'price_in_cents' => 'required|integer',
            'size' => 'required|integer',
            'description' => 'required|string',
        ]);
    
        // Create a new pizza record
        $pizza = new Pizza();
        $pizza->flavour = $request->input('flavour');
        $pizza->price_in_cents = $request->input('price_in_cents');
        $pizza->size = $request->input('size');
        $pizza->description = $request->input('description');
        // Add more fields as needed
        $pizza->save();
    
        return response()->json([
            'message' => 'Pizza created successfully',
            'pizza' => $pizza
        ], 201);
    }

    public function delete_pizza(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);
    
        // Find the pizza by ID
        $pizza = Pizza::find($request->input('id'));
    
        if ($pizza) {
            // Delete the pizza
            $pizza->delete();
    
            return response()->json([
                'message' => 'Pizza deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Pizza not found'
            ], 404);
        }
    }

    public function list_pizzas(Request $request)
    {
        $pizzas = Pizza::all();

        return response()->json([
            'message' => 'Pizzas retrieved successfully',
            'pizzas' => $pizzas
        ], 200);
    }

    public function show_pizza_by_id($id)
    {
        $pizza = Pizza::findOrFail($id);
        return response()->json([
            'message' => 'Pizza retrieved successfully',
            'pizza' => $pizza
        ], 200);
    }

    public function update_pizza($id, Request $request)
    {
        $pizza = Pizza::findOrFail($id);
        $request->validate([
            'flavour' => 'required|string',
            'price_in_cents' => 'required|integer',
            'description' => 'required|string',
        ]);

        $pizza->flavour = $request->input('flavour');
        $pizza->price_in_cents = $request->input('price_in_cents');
        $pizza->description = $request->input('description');

        $pizza->save();

        return response()->json([
            'message' => 'Pizza updated successfully',
            'pizza' => $pizza
        ], 200);
    }

    
}
 