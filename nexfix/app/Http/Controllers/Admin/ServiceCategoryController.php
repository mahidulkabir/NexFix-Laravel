<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceCategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = ServiceCategory::all();
        return view('admin.service_categories.index', compact('categories'));
    }

    // Show service categories to frontend (optional)
    public function showServiceCategory()
    {
        $categories = ServiceCategory::latest()->take(4)->get();
        return view('portal.index', compact('categories'));
    }

    // Show create form
    public function create()
    {
        return view('admin.service_categories.create');
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:service_categories,name',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        ServiceCategory::create($data);

        return redirect()->route('service-categories.index')->with('success', 'Category added successfully.');
    }

    // Show edit form
    public function edit(ServiceCategory $serviceCategory)
    {
        return view('admin.service_categories.edit', compact('serviceCategory'));
    }

    // Update category
    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $request->validate([
            'name' => 'required|unique:service_categories,name,' . $serviceCategory->id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($serviceCategory->image && Storage::disk('public')->exists($serviceCategory->image)) {
                Storage::disk('public')->delete($serviceCategory->image);
            }

            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $serviceCategory->update($data);

        return redirect()->route('service-categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy(ServiceCategory $serviceCategory)
    {
        if ($serviceCategory->image && Storage::disk('public')->exists($serviceCategory->image)) {
            Storage::disk('public')->delete($serviceCategory->image);
        }

        $serviceCategory->delete();
        return redirect()->route('service-categories.index')->with('success', 'Category deleted successfully.');
    }
}
