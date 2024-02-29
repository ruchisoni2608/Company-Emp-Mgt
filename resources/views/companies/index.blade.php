@extends('layouts.main')
@section('content1')
    <div class="container">
        <h2>Company</h2>
        <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3 float-end">Add Company</a>
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
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>
                            @if ($company->logo)
                                <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" width="100"
                                    height="100">
                            @else
                                No Logo
                            @endif
                        </td>
                        <td>{{ $company->website }}</td>
                        <td>
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST"
                                style="display: inline;">
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
