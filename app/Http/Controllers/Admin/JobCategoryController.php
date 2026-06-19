<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use Illuminate\Http\Request;

class JobCategoryController extends Controller
{
    public function index()
    {
        $categories = JobCategory::latest()->paginate(10);

        return view('admin.job-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.job-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:job_categories,name'],
        ]);

        JobCategory::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.job-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function show(JobCategory $jobCategory)
    {
        return view('admin.job-categories.show', compact('jobCategory'));
    }

    public function edit(JobCategory $jobCategory)
    {
        return view('admin.job-categories.edit', compact('jobCategory'));
    }

    public function update(Request $request, JobCategory $jobCategory)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:job_categories,name,' . $jobCategory->id],
        ]);

        $jobCategory->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('admin.job-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(JobCategory $jobCategory)
    {
        $jobCategory->delete();

        return redirect()
            ->route('admin.job-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
