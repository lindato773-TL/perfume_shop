<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Perfume;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'users' => User::count(),
                'perfumes' => Perfume::count(),
                'categories' => Category::count(),
                'lowStock' => Perfume::whereBetween('stock', [1, 5])->count(),
                'soldOut' => Perfume::where('stock', 0)->count(),
            ],
            'latestPerfumes' => Perfume::with('category')->latest()->take(5)->get(),
        ]);
    }
}
