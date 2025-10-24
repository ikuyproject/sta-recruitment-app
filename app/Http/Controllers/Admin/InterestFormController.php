<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\InterestForm; // <-- 1. Import the Model

class InterestFormController extends Controller
{
    /**
     * (GET) Display the table of interest form submissions.
     */
    public function index(): View
    {
        // 2. Fetch all interest form data, including student and program info
        $interestForms = InterestForm::with('student', 'program')
                            ->orderBy('created_at', 'desc') // Show newest first
                            ->get();

        // 3. Send the data to the view
        return view('admin.interest_forms.index', compact('interestForms'));
    }

    // (We might add delete functionality later if needed)
    // public function destroy(InterestForm $interestForm) { ... }
}