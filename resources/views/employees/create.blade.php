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
            <select class="form-select" id="company_id" name="company_id" >
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('company_id'))
            <span class="text-danger">{{ $errors->first('company_id') }}</span>
        @endif
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="name" name="first_name" placeholder="First Name" >
            @if ($errors->has('first_name'))
            <span class="text-danger">{{ $errors->first('first_name') }}</span>
        @endif
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="name" name="last_name" placeholder="Last Name" >
            @if ($errors->has('last_name'))
            <span class="text-danger">{{ $errors->first('last_name') }}</span>
        @endif
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Email</label>
            <input type="email" class="form-control" id="name" name="email" placeholder="Email" >
            @if ($errors->has('email'))
            <span class="text-danger">{{ $errors->first('email') }}</span>
        @endif
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Phone Number</label>
            <input type="number" class="form-control" id="name" name="phone" placeholder="Phone Number" >

        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>

</script>
@endsection
