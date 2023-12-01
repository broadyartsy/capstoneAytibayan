<!DOCTYPE html>
<html>

<head>
    <title>Add Program</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="{{ asset('Assets/css/itstaff.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/css/UserProfile.css') }}">

    {{-- Jquery CDN --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script>
        // itstaff.js

        document.addEventListener("DOMContentLoaded", function() {
            const numColumnsInput = document.getElementById("num_columns");
            const generateButton = document.getElementById("generate-columns");
            const columnInputsContainer = document.getElementById("column-inputs");

            generateButton.addEventListener("click", function() {
                const numColumns = parseInt(numColumnsInput.value);
                columnInputsContainer.innerHTML = ""; // Clear previous inputs

                for (let i = 1; i <= numColumns; i++) {
                    const columnGroup = document.createElement("div");
                    columnGroup.classList.add("input-group"); // Add input-group class

                    const columnDiv = document.createElement("div");
                    columnDiv.classList.add("column-div"); // Add column-div class

                    const nameLabel = document.createElement("label");
                    nameLabel.textContent = `Column ${i} Name:`;
                    const nameInput = document.createElement("input");
                    nameInput.type = "text";
                    nameInput.name = `column_name_${i}`;
                    nameInput.placeholder = ``;
                    nameInput.classList.add("column-input"); // Add column-input class

                    const typeLabel = document.createElement("label");
                    typeLabel.textContent = `Data Type:`;
                    const typeSelect = document.createElement("select");
                    typeSelect.name = `column_type_${i}`;
                    typeSelect.classList.add("column-input"); // Add column-input class
                    // Add data type options to the select dropdown
                    const dataTypes = ["Text", "Int", "Date", "Boolean"];
                    dataTypes.forEach(dataType => {
                        const option = document.createElement("option");
                        option.value = dataType.toLowerCase();
                        option.textContent = dataType;
                        typeSelect.appendChild(option);
                    });

                    columnDiv.appendChild(nameLabel);
                    columnDiv.appendChild(nameInput);
                    columnDiv.appendChild(typeLabel);
                    columnDiv.appendChild(typeSelect);

                    columnGroup.appendChild(columnDiv);

                    columnInputsContainer.appendChild(columnGroup);
                }
            });
        });
    </script>

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

</head>

<body>
    <div class="program-form">
        <form method="post" id="myForm" action="{{ route('itstaff.addNewProgram') }}" enctype="multipart/form-data">
            @csrf
            <h1>Program Information</h1>

            <div class="form-row">
                {{-- <div class="input-group">
                    <label for="inputProgram" class="form-label">Project Coordinator:</label>
                    <select id="inputCoordinator" class="form-select" name="inputCoordinator">
                        @foreach ($coordinators as $coordinator)
                            <option value="{{ $coordinator->id }}">{{ $coordinator->first_name }}
                                {{ $coordinator->middle_name }} {{ $coordinator->last_name }}</option>
                        @endforeach
                    </select>
                    @error('inputCoordinator')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div> --}}

                <div class="input-group">
                    <label for="programnameInput">Name of the Program:</label>
                    <input type="text" id="programnameInput" placeholder="Example Program" name="programnameInput">
                    @error('programnameInput')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="password">Add Program Key:</label>
                    <input type="password" id="password" placeholder="########" name="password">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="password_confirmation">Confirm Program Key:</label>
                    <input type="password" id="password_confirmation" placeholder="########"
                        name="password_confirmation">
                </div>
            </div>

            <div class="form-row">
                <div class="input-group">
                    <label for="inputLocation">Location:</label>
                    <input type="text" id="inputLocation" placeholder="Enter Location" name="inputLocation">
                    @error('inputLocation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="inputEmail">Email Address:</label>
                    <input type="email" id="inputEmail" placeholder="juandelacruz@gmail.com" name="inputEmail">
                    @error('inputEmail')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="inputContact">Contact Number:</label>
                    <input type="tel" id="inputContact" placeholder="09xxxxxxxxx" name="inputContact">
                    @error('inputContact')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="inputInfo">Program Information:</label>
                    <textarea id="inputInfo" placeholder="Program Info Here" name="inputInfo"></textarea>
                    @error('inputInfo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div class="form-row">
                <div class="input-group">
                    <label for="inputApply">How to Apply:</label>
                    <textarea id="inputApply" placeholder="Application Guidelines" name="inputApply"></textarea>
                    @error('inputApply')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="inputReqs">Guidelines and Requirements:</label>
                    <textarea id="inputReqs" placeholder="Program Requirements" name="inputReqs"></textarea>
                    @error('inputReqs')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                <label for="programPhoto">Program Image:</label>
                <input type="file" class="custom-file-label" id="programPhoto" name="programPhoto">
               
                <div class="image-container">
                <img id="image-preview"
                    src="{{ !empty($program->image) ? url('Uploads/Program_images/' . $program->image) : url('Uploads/no-image.jpg') }}"
                    alt="User Profile Image" class="img-fluid-small  rounded-circle">
                 {{-- <span class="delete-icon" id="delete-image-btn">×</span> --}}
                 </div>
            
            </div>
            </div>
            <div class="form-row1">
                <div class="input-group">
                    <label for="input-BackgroundImage">Program Background Image:</label>
                    <input type="file" class="custom-file-label"
                        id="input-BackgroundImage" name="programBackgroundPhoto">
               
                <div class="image-container">
                    <img id="image-preview1"
                        src="{{ !empty($program->background_image) ? url('Uploads/Program_images/' . $program->background_image) : url('Uploads/no-image.jpg') }}"
                        alt="Program Background Image" class="img-fluid-small  rounded-circle">
                   {{-- <span class="delete-icon" id="delete-image-btn">×</span>  --}}
                </div>
                </div>
            </div>

            {{-- <div class="form-row">
                <div class="input-group">
                    <label for="table_name">Table Name:</label>
                    <input type="text" id="table_name" name="table">
                </div>
                <div class="input-group">
                    <label for="num_columns">Number of Columns:</label>
                    <input type="number" id="num_columns" min="1" max="10" name="columns">
                </div>
            </div>

            <div id="generate-button" class="center">
                <button id="generate-columns" type="button">Generate Columns</button>
            </div> --}}

            {{-- <div id="column-inputs">
                <!-- Column name and datatype inputs will be generated here -->
            </div> --}}
            <button type="submit" class="btn btn-primary me-2">Add Program</button>


        </form>
        <a href="{{ route('itstaff.home') }}" class="button discard-button">Discard</a>
    </div>


    </form>

    <script>
        $(document).ready(function() {
            const imageInput = $('#input-ProfileImage');
            const imagePreview = $('#image-preview');
            const deleteImageBtn = $('#delete-image-btn');

            // Function to hide the delete button
            function hideDeleteButton() {
                deleteImageBtn.hide();
            }

            // Function to show the delete button
            function showDeleteButton() {
                deleteImageBtn.show();
            }

            // Function to update the image preview
            function updateImagePreview(file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
            }

            // Hide the delete button initially if the default picture is viewed
            if (imagePreview.attr('src') ===
                '{{ asset('Uploads/user-icon-png-person-user-profile-icon-20.png') }}') {
                hideDeleteButton();
            }

            // Listen for file input change
            imageInput.change(function(e) {
                const selectedFile = e.target.files[0];
                if (selectedFile) {
                    updateImagePreview(selectedFile);
                    showDeleteButton();
                } else {
                    hideDeleteButton();
                }
            });

            // Listen for delete image button click
            deleteImageBtn.click(function() {
                imageInput.val(''); // Clear the file input
                imagePreview.attr('src',
                    '{{ asset('Uploads/user-icon-png-person-user-profile-icon-20.png') }}'
                ); // Restore the default image
                hideDeleteButton();
            });

            // Additional script for image input change (if needed)
            $('#programPhoto').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#input-BackgroundImage').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview1').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

</body>

</html>
