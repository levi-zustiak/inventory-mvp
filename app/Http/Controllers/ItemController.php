<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Company;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request, Company $company, Campaign $campaign)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'string',
            'quantity' => 'required|integer',
        ]);

        $campaign->items()->create([
            ...$validated,
            'created_by' => $request->user()->id,
        ]);
//
//        $instances = [];
//
//        for ($i = 0; $i < $validated['quantity']; $i++) {
//            array_push($instances, []);
//        }
//
//        $item->instances()->createMany($instances);
    }
}
