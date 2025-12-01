<?php

namespace App\Http\Controllers;
use App\Models\Service;
use App\Models\Vendor;
use Illuminate\Support\Facades\Auth;

class AllServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();

        return view('portal.allService', compact( 'services'));
    }
    public function serviceDetail($id)
    {
        $service = Service::findOrFail($id);
        return view('portal.serviceDetail',compact('service'));
    }

   public function checkoutRedirect($id)
{
    $service = Service::findOrFail($id);

    if (!Auth::check()) {
        // User not logged in → remember this service and go to login
        session(['intended_service' => $id]);
        return redirect()->route('login');
    }
    // logged in user 
    $user = Auth::user();
    // $vendors = Vendor::where('service_id', $id)->get();
    // User logged in → show checkout page
    return view('portal.checkout', compact('service','user'));
}
}