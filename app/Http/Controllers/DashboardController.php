<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Perfume;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View|RedirectResponse
    {
        if (auth()->check() && auth()->user()->isStaff()) {
            return redirect()->route('admin.dashboard');
        }

        if (! auth()->check()) {
            return view('welcome');
        }

        return view('dashboard', [
            'categories' => Category::where('is_active', true)->withCount('perfumes')->latest()->get(),
            'featured' => Perfume::with('category')->where('is_active', true)->where('is_featured', true)->latest()->take(6)->get(),
            'totalPerfumes' => Perfume::where('is_active', true)->count(),
        ]);
    }
}
