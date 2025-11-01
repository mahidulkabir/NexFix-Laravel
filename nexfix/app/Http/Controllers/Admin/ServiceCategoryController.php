<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function index() {
        $categories = ServiceCategory::all();
        return view('admin.service_categories.index', compact('categories'));
    }
    public function showServiceCategory(){
        $categories = ServiceCategory::all();
        return view('portal.index', compact('categories'));
    }




    public function create() {
        return view('admin.service_categories.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:service_categories,name',
        ]);

        ServiceCategory::create($request->all());
        return redirect()->route('service-categories.index')->with('success', 'Category added successfully.');
    }

    public function edit(ServiceCategory $serviceCategory) {
        return view('admin.service_categories.edit', compact('serviceCategory'));
    }

    public function update(Request $request, ServiceCategory $serviceCategory) {
        $request->validate([
            'name' => 'required|unique:service_categories,name,' . $serviceCategory->id,
        ]);

        $serviceCategory->update($request->all());
        return redirect()->route('service-categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(ServiceCategory $serviceCategory) {
        $serviceCategory->delete();
        return redirect()->route('service-categories.index')->with('success', 'Category deleted successfully.');
    }
}
