<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Campaign;
use App\Models\Company;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function store(Request $request, Company $company, Campaign $campaign)
    {
        foreach ($request->input('items') as $item) {
            Assignment::create([
                'item_id' => $item['id'],
                'assigned_by' => $request->user()->id,
                'assigned_to' => $request->input('assigned_to'),
                'quantity' => $item['requested_quantity'],
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

    public function update(Request $request, Assignment $assignment)
    {
        $assignment->update(['returned_at' => Carbon::now()]);
    }
}
