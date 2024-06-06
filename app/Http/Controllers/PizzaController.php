<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;


class PizzaController extends Controller
{
    //
    public function createPizza(Request $request)
    {
        $request->validate([
            'flavour' => 'required|string',
            'price_in_cents' => 'required|integer',
            'size' => 'required|integer',
        ]);
    
        // Create a new pizza record
        $pizza = new Pizza();
        $pizza->flavour = $request->input('flavour');
        $pizza->price_in_cents = $request->input('price_in_cents');
        $pizza->size = $request->input('size');
        // Add more fields as needed
        $pizza->save();
    
        return response()->json([
            'message' => 'Pizza created successfully',
            'pizza' => $pizza
        ], 201);
    }

    public function deletePizza(Request $request)
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

    public function listPizzas(Request $request)
{
    $request->validate([
        'category' => 'required|string',
    ]);

    // Retrieve pizzas by category
    $category = $request->input('category');
    $pizzas = Pizza::where('category', $category)->get();

    return response()->json([
        'message' => 'Pizzas retrieved successfully',
        'pizzas' => $pizzas
    ], 200);
}

    
}
