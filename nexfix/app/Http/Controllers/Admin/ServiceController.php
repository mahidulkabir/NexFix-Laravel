<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services =Service::with('category')->latest()->paginate(10);
        return view('admin.services.index',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ServiceCategory::all();
        return view('admin.services.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required',
            'details'=>'required',
            'service_category_id'=>'required|exists:service_categories,id',
            'base_price'=>'required|numeric|min:0',
            'image'=>'required|image|mimes:jpg,jpeg|max:512',
        ]);
          $imagePath=$request->file('image')->store('services','public');
          Service::create([
            'name'=>$request->name,
            'description'=> $request->description,
            'details'=> $request->details,
            'service_category_id'=>$request->service_category_id,
            'base_price'=>$request->base_price,
            'image'=>$imagePath,
            'active'=>$request->has('active'),
          ]);
          return redirect()->route('services.index')->with('success','Service Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $categories=ServiceCategory::all();
        return view('admin.services.edit',compact('service','categories'));
    }
    public function showPortalService(Service $service)
    {
        $services=ServiceCategory::all();
        return view('portal.index',compact('service','services'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Service $service)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required',
            'details'=>'required',
            'service_category_id' =>'required|exists:service_categories,id',
            'base_price' =>'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg|max:512',
        ]);
        $data = $request->only(['name', 'description', 'details', 'service_category_id', 'base_price', 'active']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $data['active'] = $request->has('active');
        $service->update($data);

        return redirect()->route('services.index')->with('success', 'Service updated successfully!');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully!');
    }
}
