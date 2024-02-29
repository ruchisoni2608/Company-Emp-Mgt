@extends('layouts.main')
@section('content1')
<div class="container">
    <h2>Employee</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3 float-end">Add Employees</a>
    <a href="{{ route('admin.home') }}" class="btn btn-success mb-3">Back</a>
    @if (session('success'))
    <div class="alert alert-success" >
        {{ session('success') }}
    </div>
    @endif
    <table class="table" id="countriesTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1; ?>
            @foreach ($employees as $emp)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $emp->first_name }} {{$emp->last_name}}</td>
                    <td>{{ $emp->email}}</td>
                    <td>{{ $emp->phone }}</td>
                    <td>{{ $emp->company->name }}</td>

                    <td>
                        {{-- <a href="#" class="btn btn-warning">Live Peview</a> --}}
                        <a href="{{ route('employees.edit', $emp->id) }}" class="btn btn-info">Edit</a>
                        <form action="{{ route('employees.destroy', $emp->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var $j = jQuery.noConflict();
</script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $j(document).ready(function() {
            $j('#countriesTable').DataTable();
        });
        var successMessage = document.getElementById('successMessage');

        // Set a timeout to hide the success message after 5 seconds (5000 milliseconds)
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>


@endsection
