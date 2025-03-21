<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        
        public function index()
        {
            return response()->json(Project::all());
        }

        
        public function store(Request $request)
        {
            
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'image' => 'nullable|image|max:2048', 
                'link' => 'nullable|string',
            ]);

            
            $imagePath = null;
            if ($request->hasFile('image')) {
                
                $imagePath = $request->file('image')->store('projects', 'public'); 
            }

            
            $project = Auth::user()->projects()->create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imagePath ? asset('storage/' . $imagePath) : null, 
                'link' => $request->link,
            ]);

            
            return response()->json([
                'message' => 'تمت إضافة المشروع بنجاح',
                'project' => $project
            ]);
        }

        public function update(Request $request, $id)
{
    $project = Auth::user()->projects()->findOrFail($id);

    $request->validate([
        'title' => 'sometimes|string|max:255',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        'link' => 'nullable|string',
    ]);

    
    if ($request->hasFile('image')) {
        
        if ($project->image) {
            Storage::delete(str_replace(asset('storage/'), '', $project->image));
        }

        
        $imagePath = $request->file('image')->store('projects', 'public');
        $project->image = asset('storage/' . $imagePath);
    }

    
    $project->update([
        'title' => $request->title ?? $project->title,
        'description' => $request->description ?? $project->description,
        'link' => $request->link ?? $project->link,
    ]);

    return response()->json([
        'message' => 'تم تحديث المشروع بنجاح',
        'project' => $project
    ]);
}





        
        public function destroy(Project $project)
        {
            $project->delete();
            return response()->json(['message' => 'تم حذف المشروع بنجاح']);
        }
}
