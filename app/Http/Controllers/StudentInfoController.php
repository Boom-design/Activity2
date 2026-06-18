<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     * Demonstrates: Save Student Record -> Success Message
     * Demonstrates: Empty Form Submission -> Validation Error
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|string|unique:student_infos',
            'name' => 'required|string',
            'course' => 'required|string',
            'birthdate' => 'nullable|date',
            'email_address' => 'nullable|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('student_infos.index')
                ->withErrors($validator)
                ->withInput();
        }

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
            ->with('success', 'Student record added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentInfo $student_info)
    {
        return view('students.show', compact('student_info'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentInfo $student_info)
    {
        return view('students.edit', compact('student_info'));
    }

    /**
     * Update the specified resource in storage.
     * Demonstrates: Save Student Record -> Success Message
     * Demonstrates: Empty Form Submission -> Validation Error
     */
    public function update(Request $request, StudentInfo $student_info)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|string|unique:student_infos,student_id,' . $student_info->id,
            'name' => 'required|string',
            'course' => 'required|string',
            'birthdate' => 'nullable|date',
            'email_address' => 'nullable|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('student_infos.index')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['path'] = $imageName;
        }

        $student_info->update($data);
        return redirect()->route('student_infos.index')
            ->with('success', 'Student record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     * Demonstrates: Save Student Record -> Success Message
     */
    public function destroy(StudentInfo $student_info)
    {
        // Redirect with warning and an Okay button
        return redirect()->route('student_infos.index')
            ->with('warning', 'Warning: Are you sure you want to delete this student record? <a href="' . route('student_infos.force_destroy', $student_info->id) . '" class="btn btn-sm btn-danger ms-2">Okay</a>');
    }

    public function forceDestroy(StudentInfo $student_info)
    {
        $student_info->delete();
        return redirect()->route('student_infos.index')
            ->with('success', 'Student record permanently deleted!');
    }

    /**
     * Example: Invalid Action -> Error Message
     */
    public function invalidAction()
    {
        return redirect()->route('student_infos.index')->with('error', 'Woops, Something is wrong!');
    }

    /**
     * Example: Restricted Page Access -> Warning Message
     */
    public function restrictedAccess()
    {
        return redirect()->route('student_infos.index')->with('warning', 'Access restricted. This action requires special permission!');
    }

    /**
     * Example: Display System Notice -> Info Message
     */
    public function systemNotice()
    {
        return redirect()->route('student_infos.index')->with('info', 'Please update your student information to proceed with enrollment!');
    }
}
