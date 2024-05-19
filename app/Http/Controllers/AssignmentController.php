<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Campaign;
use App\Models\Company;
use App\Models\Item;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function store(Request $request, Company $company, Campaign $campaign)
    {
        foreach ($request->input('items') as $requested) {
            $item = Item::find(1);

            $item->assignments()->create([
                'assigned_by' => $request->user()->id,
                'assigned_to' => $request->input('assigned_to'),
                'quantity' => $requested['quantity'],
            ]);


//            $n = $item->assignments()->take($requested['quantity'])->get();
//            $instances = $item->availableInstances()->take($requested['quantity'])->get();

//            $item->available_quantity;

//            foreach ($instances as $instance) {
//                $instance->assignment()->create([
//                    'assigned_by' => $request->user()->id,
//                    'assigned_to' => $request->input('assigned_to'),
//                    'active' => true
//                ]);
//            }
        }

        return;
    }
}
