<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    public function index()
    {
        $vacancies = Vacancy::all();
        return view('jobs.index', compact('vacancies'));
    }

    public function show($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        return view('jobs.show', compact('vacancy'));
    }
}