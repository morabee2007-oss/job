<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with(['job', 'candidate'])
            ->whereHas('job', function ($query) {
                $query->where('employer_id', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('employer.applications.index', compact('applications'));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        $request->validate([
            'status' => ['required', 'in:pending,reviewed,accepted,rejected'],
        ]);

        abort_unless($application->job->employer_id === auth()->id(), 403);

        $application->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Application status updated successfully.');
    }
}
