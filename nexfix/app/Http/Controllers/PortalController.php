<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\Service;

class PortalController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::all();
        $services = Service::all();

        return view('portal.index', compact('categories', 'services'));
    }
    public function serviceDetail($id)
    {
        $service = Service::findOrFail($id);
        return view('portal.serviceDetail',compact('service'));
    }
}