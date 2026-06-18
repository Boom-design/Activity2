@extends('master')
@section('content')

<h1>Student Information System</h1>

<a href="{{ route('student_infos.create') }}" class="btn btn-success mb-3">Add New Student</a>

<h2 class="mt-4">Student Records</h2>

@if($studentInfos->count() > 0)
    @foreach ($studentInfos as $studentInfo)
        <div class="card mt-3">
            @if($studentInfo->path)
                <img src="{{ asset('images/' . $studentInfo->path) }}" class="card-img-top" alt="{{ $studentInfo->name }}" style="max-height: 300px; object-fit: cover;">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $studentInfo->name }}</h5>
                <p class="card-text"><strong>Student ID:</strong> {{ $studentInfo->student_id }}</p>
                <p class="card-text"><strong>Course:</strong> {{ $studentInfo->course ?? 'N/A' }}</p>
                <p class="card-text"><strong>Birthdate:</strong> {{ $studentInfo->birthdate ?? 'N/A' }}</p>
                <p class="card-text"><strong>Email Address:</strong> {{ $studentInfo->email_address ?? 'N/A' }}</p>
                <div class="mt-3">
                    <a href="{{ route('student_infos.show', $studentInfo->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('student_infos.edit', $studentInfo->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('student_infos.destroy', $studentInfo->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="alert alert-info mt-3">
        No student records found. <a href="{{ route('student_infos.create') }}">Add one now</a>
    </div>
@endif

@endsection