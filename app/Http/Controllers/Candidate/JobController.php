<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function landing(Request $request)
    {
        $categories = JobCategory::orderBy('name')->get();

        $jobs = Job::with(['employer.companyProfile', 'category'])
            ->where('status', 'open')
            ->where('approval_status', 'approved')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->job_category_id, function ($query, $categoryId) {
                $query->where('job_category_id', $categoryId);
            })
            ->when($request->job_type, function ($query, $jobType) {
                $query->where('job_type', $jobType);
            })
            ->when($request->location, function ($query, $location) {
                $query->where('location', 'like', "%{$location}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('welcome', compact('jobs', 'categories'));
    }

    public function index(Request $request)
    {
        $categories = JobCategory::orderBy('name')->get();

        $jobs = Job::with(['employer.companyProfile', 'category'])
            ->where('status', 'open')
            ->where('approval_status', 'approved')
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->job_category_id, function ($query, $categoryId) {
                $query->where('job_category_id', $categoryId);
            })
            ->when($request->job_type, function ($query, $jobType) {
                $query->where('job_type', $jobType);
            })
            ->when($request->location, function ($query, $location) {
                $query->where('location', 'like', "%{$location}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('candidate.jobs.index', compact('jobs', 'categories'));
    }

    public function publicShow(Job $job)
    {
        abort_if($job->status !== 'open' || $job->approval_status !== 'approved', 404);

        $job->load(['employer.companyProfile', 'category']);

        return view('jobs.show', compact('job'));
    }

    public function show(Job $job)
    {
        abort_if($job->status !== 'open' || $job->approval_status !== 'approved', 404);

        $job->load(['employer.companyProfile', 'category']);

        return view('candidate.jobs.show', compact('job'));
    }
}
