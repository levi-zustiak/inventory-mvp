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
        $item = $campaign->items()->create([
            ...$request->input(),
            'created_by' => 1,
        ]);

        return;
    }
}
