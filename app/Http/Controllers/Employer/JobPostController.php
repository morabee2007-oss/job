<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{
    public function index()
    {
        $jobs = Job::with('category')
            ->where('employer_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('employer.job-posts.index', compact('jobs'));
    }

    public function create()
    {
        $categories = JobCategory::orderBy('name')->get();

        return view('employer.job-posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'job_category_id' => ['nullable', 'exists:job_categories,id'],
            'new_category' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'job_type' => ['required', 'in:full_time,part_time,remote,freelance'],
            'salary_min' => ['nullable', 'numeric', 'min:0'],
            'salary_max' => ['nullable', 'numeric', 'min:0', 'gte:salary_min'],
            'deadline' => ['nullable', 'date'],
        ]);

        if (!$request->job_category_id && !$request->filled('new_category')) {
            return back()
                ->withErrors([
                    'job_category_id' => 'Please select a category or add a new one.',
                ])
                ->withInput();
        }

        $categoryId = $request->job_category_id;

        if (!$categoryId && $request->filled('new_category')) {
            $category = JobCategory::firstOrCreate([
                'name' => trim($request->new_category),
            ]);

            $categoryId = $category->id;
        }

        Job::create([
            'employer_id' => Auth::id(),
            'job_category_id' => $categoryId,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'job_type' => $request->job_type,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'deadline' => $request->deadline,
            'status' => 'open',
            'approval_status' => 'pending',
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return redirect()
            ->route('employer.job-posts.index')
            ->with('success', 'Job post created successfully and sent for admin approval.');
    }

    public function show(Job $jobPost)
    {
        abort_unless($jobPost->employer_id === Auth::id(), 403);

        $jobPost->load([
            'category',
            'applications.candidate',
            'approver',
        ]);

        return view('employer.job-posts.show', [
            'job' => $jobPost,
        ]);
    }

    public function edit(Job $jobPost)
    {
        abort_unless($jobPost->employer_id === Auth::id(), 403);

        $categories = JobCategory::orderBy('name')->get();

        return view('employer.job-posts.edit', [
            'job' => $jobPost,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Job $jobPost)
    {
        abort_unless($jobPost->employer_id === Auth::id(), 403);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'job_category_id' => ['nullable', 'exists:job_categories,id'],
            'new_category' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'job_type' => ['required', 'in:full_time,part_time,remote,freelance'],
            'salary_min' => ['nullable', 'numeric', 'min:0'],
            'salary_max' => ['nullable', 'numeric', 'min:0', 'gte:salary_min'],
            'deadline' => ['nullable', 'date'],
        ]);

        if (!$request->job_category_id && !$request->filled('new_category')) {
            return back()
                ->withErrors([
                    'job_category_id' => 'Please select a category or add a new one.',
                ])
                ->withInput();
        }

        $categoryId = $request->job_category_id;

        if (!$categoryId && $request->filled('new_category')) {
            $category = JobCategory::firstOrCreate([
                'name' => trim($request->new_category),
            ]);

            $categoryId = $category->id;
        }

        $jobPost->update([
            'job_category_id' => $categoryId,
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
            'job_type' => $request->job_type,
            'salary_min' => $request->salary_min,
            'salary_max' => $request->salary_max,
            'deadline' => $request->deadline,
            'status' => 'open',
            'approval_status' => 'pending',
            'approved_by' => null,
            'approved_at' => null,
        ]);

        return redirect()
            ->route('employer.job-posts.index')
            ->with('success', 'Job post updated successfully and sent again for admin approval.');
    }

    public function destroy(Job $jobPost)
    {
        abort_unless($jobPost->employer_id === Auth::id(), 403);

        $jobPost->delete();

        return redirect()
            ->route('employer.job-posts.index')
            ->with('success', 'Job post deleted successfully.');
    }
}
