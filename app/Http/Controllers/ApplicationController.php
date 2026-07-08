<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'vacancy_id' => 'required|exists:vacancies,id',
            'notes' => 'nullable|string'
        ]);

        Application::create([
            'user_id' => Auth::id() ?? 1,
            'vacancy_id' => $request->vacancy_id,
            'notes' => $request->notes,
            'status' => 'Sedang Ditinjau'
        ]);

        return redirect()->route('applications.index');
    }

    public function index()
    {
        $applications = Application::with('vacancy')->where('user_id', Auth::id() ?? 1)->get();
        return view('applications.index', compact('applications'));
    }

    public function show(int $id)
    {
        $application = Application::with('vacancy')->where('user_id', Auth::id() ?? 1)->findOrFail($id);
        return view('applications.show', compact('application'));
    }
}