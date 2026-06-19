<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        $user = $request->user();

        return view('profile.edit', [
            'user' => $user,
            'candidateProfile' => $user->candidateProfile,
            'companyProfile' => $user->companyProfile,
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function updateExtra(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->role === 'candidate') {
            $validated = $request->validate([
                'date_of_birth' => ['nullable', 'date'],
                'gender' => ['nullable', 'string', 'max:50'],
                'address' => ['nullable', 'string', 'max:255'],
                'bio' => ['nullable', 'string'],
                'years_of_experience' => ['nullable', 'integer', 'min:0'],
                'cv' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048'],
            ]);

            $profile = $user->candidateProfile()->firstOrCreate([]);

            if ($request->hasFile('cv')) {
                if ($profile->cv) {
                    Storage::disk('public')->delete($profile->cv);
                }

                $validated['cv'] = $request->file('cv')->store('cvs', 'public');
            }

            $profile->update($validated);
        }

        if ($user->role === 'employer') {
            $validated = $request->validate([
                'company_name' => ['required', 'string', 'max:255'],
                'website' => ['nullable', 'url', 'max:255'],
                'location' => ['nullable', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
                'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            ]);

            $profile = $user->companyProfile()->firstOrCreate([
                'company_name' => $user->name,
            ]);

            if ($request->hasFile('logo')) {
                if ($profile->logo) {
                    Storage::disk('public')->delete($profile->logo);
                }

                $validated['logo'] = $request->file('logo')->store('company-logos', 'public');
            }

            $profile->update($validated);
        }

        return Redirect::route('profile.edit')->with('status', 'extra-profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
