<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{
    public function index()
    {
        $jobs = Job::with(['employer.companyProfile', 'category'])
            ->orderByRaw("
                CASE approval_status
                    WHEN 'pending' THEN 0
                    WHEN 'approved' THEN 1
                    WHEN 'rejected' THEN 2
                    ELSE 3
                END
            ")
            ->latest()
            ->paginate(10);

        return view('admin.job-posts.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        $job->load([
            'employer.companyProfile',
            'category',
            'applications.candidate',
            'approver',
        ]);

        return view('admin.job-posts.show', compact('job'));
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()
            ->route('admin.job-posts.index')
            ->with('success', 'Job post deleted successfully.');
    }

    public function approve(Job $job)
    {
        $job->update([
            'status' => 'open',
            'approval_status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Job post approved successfully.');
    }

    public function reject(Job $job)
    {
        $job->update([
            'approval_status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => null,
        ]);

        return back()->with('success', 'Job post rejected successfully.');
    }
}
