@extends('Beneficiary.beneficiary_main')

@section('content')
@include('beneficiary.Body.sidebar')

    @php
        // Access the authenticated user's id
    $id = Illuminate\Support\Facades\Auth::user()->id;

// Access the specific row data of the user's id
// When using a model in blade.php, indicate the direct path of the model
$userProfileData = App\Models\User::find($id);

$authUser = Illuminate\Support\Facades\Auth::user();

$description = App\Models\FinancialAssistanceStatus::find(1)->description;

        $statusName = App\Models\FinancialAssistanceStatus::find(1)->financial_assistance_status_name;

if ($authUser->assistance) {
    $userAssistanceStatus = auth()->user()->financialAssistanceStatus->financial_assistance_status_name;
}
elseif ($authUser->loan){
    $userAssistanceStatus = auth()->user()->loanstatus->loan_status_name;
}
else {
    $userAssistanceStatus = $statusName;
}
    @endphp
    <div class="title">
        <h1>UPDATE</h1>
    </div>

    <div class="container_benef mt-5">
    <div class="form-update">
        <div class="col">
        <h3 class="text-center">Beneficiary Update</h3>
        <form action="{{ route('send.updates') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Caption:</label>
                <input type="text" id="title" class="form-control" name="title" maxlength="10000000" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" value="{{ $userEmail }}" hidden>
                <input type="text" name="benef_of" value="{{ $programName }}" hidden>
            </div>
            <div class="mb-3">
                <label for="picture" class="form-label">Picture:</label>
                <label for="edit-picture" id="drop-img">
                <input name="image" type="file" id="edit-picture" style="display:none;" required>
                <div id="img-view">
                <span id="error-message" style="color: red;"></span>
                <img src="/images/image_icon.png">
                <p> Drag and drop or click here <br> to upload picture</p>
                </div>
                </label>
            </div>
            <button type="submit" class="add-modal" onclick="validateForm()">Add</button>
        </form>
        </div>
        </div>
        <div class="row mt-5">
        <div class="col mx-auto">
            <h4 class="update-details text-center">Update Details</h4>
            <div class="row">
                <!-- Update cards will be dynamically generated here -->
                @foreach($updates->reverse() as $update)
                <div class="modal fade" id="editModal{{ $update->id }}" tabindex="-1"  data-backdrop="false" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true" style="background-color: rgba(0, 0, 0, 0.5)">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Update</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="edit-form" action="{{ route('edit.updates') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" id="edit-update-id" name="update_id" value="{{ $update->id }}">
                                    <input type="hidden" id="edit-update-id" name="benef_of" value="{{ $programName }}">
                                    <input type="hidden" id="edit-update-id" name="email" value="{{ $userEmail }}">
                                    <div class="mb-3"> 
                                        <label for="edit-information" class="form-label">Edit Caption:</label>
                                        <input id="edit-information" class="form-control" value="{{ $update->title }}" name="title" required>
                                    </div>
                                    <div class="mb-3 image-update">
                                        <label for="input-file" class="form-label">Change Picture:</label>
                                            <label for="input-picture" id="drop-img">
                                            <input name="image" type="file" id="input-picture" style="display:none;" hidden>
                                                <div id="img-view">
                                                    <img src="{{ asset('Uploads/Updates/'.$update->image) }}">
                                                </div>
                                            </label>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="close" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" id="edit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3 col-md-3" id="card-update">
                <div class="card-body">
                    <a href="{{ asset('Uploads/Updates/'.$update->image) }}" target="_blank">
                        <img src="{{ asset('Uploads/Updates/'.$update->image) }}" alt="Beneficiary's Picture" class="img-thumbnail" data-update-index="{{ $update->id }}">
                    </a>
                    <p class="update-title">{{ $update->title }}</p>
                </div>
                <p class="update-date">Date: {{ $update->created_at->format('Y-m-d h:i A') }}</p>
                <div class="card-footer">
                @if($loop->first) <!-- Only show edit button for the latest post -->
                    <button class="btn btn-pink edit-update" data-bs-toggle="modal" data-bs-target="#editModal{{ $update->id }}" data-update-id="{{ $loop->index }}">
                        <i class="fa-solid fa-pen-to-square fa-lg" style="color: #58c0e2"></i>
                    </button>
                @endif
            </div>

            </div>
        @endforeach
            </div>
        </div>
    </div>
    </div>

<!-- Modal Clicking the picture -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Image will be displayed here -->
            </div>
        </div>
    </div>
</div>


@endsection

<script>
        function validateForm() {
            var fileInput = document.getElementById('edit-picture');
            var errorMessage = document.getElementById('error-message');

            // Check if a file is selected
            if (fileInput.files.length === 0) {
                errorMessage.textContent = 'Please fill out this field.';
            } else {
                // Reset the error message if a file is selected
                errorMessage.textContent = '';

                // Process the form or do other actions
                // Example: document.getElementById('myForm').submit();
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
    $(document).ready(function () {
        // Handle file input change event
        $('#input-picture').change(function () {
            // Get the selected file
            var file = this.files[0];

            if (file) {
                // Create a FileReader to read and display the image
                var reader = new FileReader();
                reader.onload = function (e) {
                    // Update the image preview
                    var $img = $('#img-view img');
                    $img.attr('src', e.target.result);

                    // Set the index to 0 for the selected image
                    var dataIndex = $img.data('update-index');
                    $img.prop('id', 0);
                };
                // Read the image as Data URL
                reader.readAsDataURL(file);
            }
        });
    });
</script>