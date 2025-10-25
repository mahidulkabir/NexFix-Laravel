<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::with('user')->latest()->paginate(10);
        return view('admin.vendors.index', compact('vendors'));
    }

    public function create()
    {
        $users = User::where('role', 'vendor')->get();
        return view('admin.vendors.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'company_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Vendor::create($request->only('user_id', 'company_name', 'phone', 'address'));
        return redirect()->route('vendors.index')->with('success', 'Vendor added successfully.');
    }

    public function edit(Vendor $vendor)
    {
        $users = User::where('role', 'vendor')->get();
        return view('admin.vendors.edit', compact('vendor', 'users'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'company_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $vendor->update($request->only('company_name', 'phone', 'address', 'verified'));
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully.');
    }
}
