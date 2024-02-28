@extends('layouts.main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<style>
    .img-thumbnail {
        max-width: 50% !important;
        height: 50% !important;
    }

#image-preview-container img{
    width:50%;
    height:15% !important;
}
</style>
@section('content1')
    <div class="container">
        <h2>Add Company</h2>
        <a href="{{ route('companies.index') }}" class="btn btn-success mb-3">Back</a>

        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data" id="companyForm">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Email</label>
                <input type="email" class="form-control" id="name" name="email" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Website </label>
                <input type="text" class="form-control" id="name" name="website" placeholder="Website" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Company Logo</label>
                <input type="file" class="form-control" id="images" name="logo" required>
                <div id="image-preview-container" class="mt-2"></div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
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

            // Check if a file is selected
            if (!logoFile) {
                alert('Please select a logo file.');
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
