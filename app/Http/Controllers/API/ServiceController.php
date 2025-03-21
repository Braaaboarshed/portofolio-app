<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Service::all());
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $service = Auth::user()->services()->create($request->all());

        return response()->json(['message' => 'تمت إضافة الخدمة بنجاح', 'service' => $service]);
    }

    public function update(Request $request, $id)
{
    
    $service = Auth::user()->services()->find($id);

    
    if (!$service) {
        return response()->json(['message' => 'الخدمة غير موجودة'], 404);
    }

    
    $request->validate([
        'title' => 'sometimes|string|max:255',
        'description' => 'nullable|string',
    ]);

    
    $service->update($request->only(['title', 'description']));

    return response()->json(['message' => 'تم تحديث الخدمة بنجاح', 'service' => $service]);
}


    
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(['message' => 'تم حذف الخدمة بنجاح']);
    }
}
