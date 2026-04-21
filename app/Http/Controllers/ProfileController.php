<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Sample dashboard data
        $stats = [
            'total_peminjaman' => 12,
            'pending_reports' => 3,
        ];

        $activities = [
            [
                'title' => 'Peminjaman Lab RPL',
                'date' => '20 May 2024',
                'status' => 'Approved',
                'status_type' => 'success'
            ],
            [
                'title' => 'Laporan Kerusakan Mouse',
                'date' => '18 May 2024',
                'status' => 'Pending',
                'status_type' => 'warning'
            ],
            [
                'title' => 'Pengembalian Alat',
                'date' => '15 May 2024',
                'status' => 'Returned',
                'status_type' => 'info'
            ]
        ];

        return view('profile', [
            'user' => $request->user(),
            'stats' => $stats,
            'activities' => $activities,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
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
