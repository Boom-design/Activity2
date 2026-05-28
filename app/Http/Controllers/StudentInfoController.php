<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentInfo;

class StudentInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentInfos = StudentInfo::all();
        return view('students.index', compact('studentInfos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'student_id' => 'required',
            'birthdate' => 'required|date',
            'email_address' => 'required|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['path'] = $imageName;
        }

        StudentInfo::create($data);
        return redirect()->route('student_infos.index')
                         ->with('success', 'Student information created successfully.');
    }

    // ...other resource methods (show, edit, update, destroy) can be added as needed
}
