<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applications = JobApplication::with(['job.employer.companyProfile'])
            ->where('candidate_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('candidate.applications.index', compact('applications'));
    }

    public function store(Request $request, Job $job)
    {
        if ($job->status !== 'open') {
            return back()->with('error', 'This job is closed.');
        }

        $alreadyApplied = JobApplication::where('job_id', $job->id)
            ->where('candidate_id', auth()->id())
            ->exists();

        if ($alreadyApplied) {
            return back()->with('error', 'You already applied for this job.');
        }

        $request->validate([
            'cover_letter' => ['nullable', 'string'],
            'resume' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
        ]);

        $resumePath = null;

        if ($request->hasFile('resume')) {
            $resumePath = $request->file('resume')->store('resumes', 'public');
        } else {
            $resumePath = auth()->user()->candidateProfile?->cv;
        }

        if (!$resumePath) {
            return back()->with('error', 'Please upload your CV before submitting your application.');
        }

        JobApplication::create([
            'job_id' => $job->id,
            'candidate_id' => auth()->id(),
            'cover_letter' => $request->cover_letter,
            'resume' => $resumePath,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Application submitted successfully.');
    }
}
