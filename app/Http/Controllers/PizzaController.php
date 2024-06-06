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
}
