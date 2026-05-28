@extends('master')
@section('content')

<h1>Personal Information</h1>

<form action="{{ route('student_infos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="student_id" class="form-label">ID</label>
        <input type="text" class="form-control" id="student_id" name="student_id" required>
    </div>
    <div class="mb-3">
        <label for="birthdate" class="form-label">Birthdate</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
    </div>
    <div class="mb-3">
        <label for="email_address" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email_address" name="email_address" required>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Upload Image</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<hr>
<h2 class="mt-5">Student Information</h2>
    @foreach ($studentInfos as $studentInfo)
        <div class="card mt-3">
            @if($studentInfo->path)
                <img src="{{ asset('images/' . $studentInfo->path) }}" class="card-img-top" alt="{{ $studentInfo->name }}" style="max-height: 300px; object-fit: cover;">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $studentInfo->name }}</h5>
                <p class="card-text"><strong>ID:</strong> {{ $studentInfo->student_id }}</p>
                <p class="card-text"><strong>Birthdate:</strong> {{ $studentInfo->birthdate }}</p>
                <p class="card-text"><strong>Email Address:</strong> {{ $studentInfo->email_address }}</p>
            </div>
        </div>
    @endforeach

@endsection