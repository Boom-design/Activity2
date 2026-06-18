@extends('master')
@section('content')

<h1>Student Record Details</h1>

<div class="card mt-3">
    @if($student_info->path)
        <img src="{{ asset('images/' . $student_info->path) }}" class="card-img-top" alt="{{ $student_info->name }}" style="max-height: 400px; object-fit: cover;">
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ $student_info->name }}</h5>
        <p class="card-text"><strong>Student ID:</strong> {{ $student_info->student_id }}</p>
        <p class="card-text"><strong>Course:</strong> {{ $student_info->course ?? 'N/A' }}</p>
        <p class="card-text"><strong>Birthdate:</strong> {{ $student_info->birthdate ?? 'N/A' }}</p>
        <p class="card-text"><strong>Email Address:</strong> {{ $student_info->email_address ?? 'N/A' }}</p>
        <div class="mt-3">
            <a href="{{ route('student_infos.edit', $student_info->id) }}" class="btn btn-warning">Edit</a>
            <a href="{{ route('student_infos.index') }}" class="btn btn-secondary">Back</a>
            <form action="{{ route('student_infos.destroy', $student_info->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
            </form>
        </div>
    </div>
</div>

@endsection
