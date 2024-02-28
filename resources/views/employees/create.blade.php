@extends('layouts.main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<style>
</style>
@section('content1')
<div class="container">
    <h2>Add Employee</h2>
    <a href="{{ route('employees.index') }}" class="btn btn-success mb-3">Back</a>

    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="company_id" class="form-label">company</label>
            <select class="form-select" id="company_id" name="company_id" required>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="name" name="first_name" placeholder="First Name" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="name" name="last_name" placeholder="Last Name" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Email</label>
            <input type="email" class="form-control" id="name" name="email" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Country Name</label>
            <input type="number" class="form-control" id="name" name="phone" placeholder="Phone Number" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>

</script>
@endsection
