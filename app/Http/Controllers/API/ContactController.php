<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        
        public function index()
        {
            return response()->json(Contact::all());
        }

        
        public function store(Request $request)
        {
            $request->validate([
                'type' => 'required|string|max:255',
                'value' => 'string|max:255',
                'link' => 'string',
            ]);

            $contact = Auth::user()->contacts()->create($request->all());

            return response()->json(['message' => 'تمت إضافة وسيلة التواصل بنجاح', 'contact' => $contact]);
        }

        public function update(Request $request, $id)
{
    
    $contact = Auth::user()->contacts()->find($id);

    
    if (!$contact) {
        return response()->json(['message' => 'وسيلة التواصل غير موجودة'], 404);
    }

    
    $request->validate([
        'type' => 'sometimes|string|max:255', 
        'value' => 'sometimes|string|max:255',
        'link' => 'nullable|string',
    ]);

    
    $contact->update($request->only(['type', 'value', 'link']));

    return response()->json([
        'message' => 'تم تحديث وسيلة التواصل بنجاح',
        'contact' => $contact
    ]);
}

        
        public function destroy(Contact $contact)
        {
            $contact->delete();
            return response()->json(['message' => 'تم حذف وسيلة التواصل بنجاح']);
        }
}
