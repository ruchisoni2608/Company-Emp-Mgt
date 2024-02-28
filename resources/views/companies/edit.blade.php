@extends('layouts.main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<style>
    .img-thumbnail {
        max-width: 50% !important;
        height: 50% !important;
    }

    #image-preview-container img {
        width: 50%;
        height: 15% !important;
    }
</style>
@section('content1')
    <div class="container">
        <h2>Edit Company</h2>
        <a href="{{ route('companies.index') }}" class="btn btn-success mb-3">Back</a>

        <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data" id="companyForm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Email</label>
                <input type="email" class="form-control" id="name" name="email" value="{{ $company->email }}" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Website</label>
                <input type="text" class="form-control" id="name" name="website" value="{{ $company->website }}" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Company Logo</label>
                <input type="file" class="form-control" id="images" name="logo">
                <div id="image-preview-container" class="mt-2">
                    @if($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Existing Logo" class="img-thumbnail">
                    @else
                        <p>No logo found</p>
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script>
        // Add event listener for file input change
        document.getElementById('images').addEventListener('change', handleFileSelect);

        function handleFileSelect(event) {
            var previewContainer = document.getElementById('image-preview-container');
            var files = event.target.files;

            // Clear previous previews
            previewContainer.innerHTML = '';

            // Loop through selected files and create image previews
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();

                reader.onload = function(e) {
                    var imgElement = document.createElement('img');
                    imgElement.setAttribute('src', e.target.result);
                    imgElement.setAttribute('class', 'img-thumbnail');
                    previewContainer.appendChild(imgElement);
                };

                reader.readAsDataURL(file);
            }
        }

        document.getElementById('companyForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            // Get the file input element
            var logoInput = document.querySelector('input[name="logo"]');
            var logoFile = logoInput.files[0];

            // If no new logo is selected, proceed with form submission
            if (!logoFile) {
                event.target.submit();
                return;
            }

            // Check if the file is an image
            if (!logoFile.type.match('image.*')) {
                alert('Please select an image file.');
                return;
            }

            // Create an image element to check the dimensions
            var img = new Image();
            img.onload = function() {
                if (img.width < 100 || img.height < 100) {
                    alert('The logo must be at least 100x100 pixels.');
                } else {
                    // If logo meets the requirements, submit the form
                    event.target.submit();
                }
            };
            img.src = URL.createObjectURL(logoFile);
        });
    </script>
@endsection
