<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Perfume;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PerfumeController extends Controller
{
    public function index(): View
    {
        return view('admin.perfumes.index', ['perfumes' => Perfume::with('category')->latest()->paginate(10)]);
    }

    public function create(): View
    {
        return view('admin.perfumes.create', ['categories' => Category::where('is_active', true)->orderBy('name')->get()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = Str::slug($data['name'].'-'.Str::random(5));
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('perfumes', 'public');
        Perfume::create($data);

        return redirect()->route('admin.perfumes.index')->with('success', 'Perfume added.');
    }

    public function edit(Perfume $perfume): View
    {
        return view('admin.perfumes.edit', ['perfume' => $perfume, 'categories' => Category::orderBy('name')->get()]);
    }

    public function update(Request $request, Perfume $perfume): RedirectResponse
    {
        $data = $this->validated($request, $perfume);
        if ($request->hasFile('image')) {
            $oldImage = $perfume->image;
            $data['image'] = $request->file('image')->store('perfumes', 'public');

            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        }
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active');
        $perfume->update($data);

        return redirect()->route('admin.perfumes.index')->with('success', 'Perfume updated.');
    }

    public function destroy(Perfume $perfume): RedirectResponse
    {
        $perfume->delete();

        return back()->with('success', 'Perfume deleted.');
    }

    private function validated(Request $request, ?Perfume $perfume = null): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:160'],
            'brand' => ['required', 'string', 'max:100'],
            'audience' => ['required', 'in:women,men,unisex'],
            'size' => ['required', 'string', 'max:30'],
            'price' => ['required', 'numeric', 'min:0'],
            'sale_price' => ['nullable', 'numeric', 'min:0', 'lte:price'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
