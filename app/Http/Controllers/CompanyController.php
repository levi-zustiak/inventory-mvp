<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    public function index()
    {
        return Inertia::render('Company/Index', [
            'companies' => Company::all(),
        ]);
    }

    public function show(Company $company) {
        return Inertia::render('Company/Show', [
            'company' => $company->load('campaigns'),
        ]);
    }
}
