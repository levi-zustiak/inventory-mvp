<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CampaignController extends Controller
{
    public function index(Company $company)
    {
        return Inertia::render('Company/Campaign/Index', [
            'company' => $company,
            'campaigns' => $company->campaigns,
        ]);
    }
    public function show(Company $company, Campaign $campaign)
    {
        return Inertia::render('Company/Campaign/Show', [
            'company' => $company,
            'campaign' => $campaign->load('items'),
        ]);
    }
}
