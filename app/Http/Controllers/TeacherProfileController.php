<?php

namespace App\Http\Controllers;

use App\Models\TeacherProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TeacherProfileController extends Controller
{
    public function home(): View
    {
        $user = auth()->user();

        $profile = TeacherProfile::where('user_id', $user?->id)->first();

        return view('teacher.home', [
            'user' => $user,
            'profile' => $profile
        ]);
    }
}
