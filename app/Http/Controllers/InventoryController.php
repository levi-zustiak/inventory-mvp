<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Inventory/Index', [
            'assignments' => $request->user()->assignments()->with('item')->get(),
            'items' => $request->user()->assignedItems()->with('assignments')->get(),
        ]);
    }
}
