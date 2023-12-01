<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Beneficiary</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS link -->
    <link rel="stylesheet" href="{{ asset('Assets/css/beneficiary.css') }}">
    <link rel="icon" href="\images\APAO logo.png" type="image icon">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>

<body class="beneficiary">

    @yield('content')
    <script src="{{ asset('Assets/js/progress.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="{{ asset('Assets/js/beneficiary.js') }}"></script>
    <script>
// Function to create an update card
function createUpdateCard(update) {
    const card = document.createElement("div");
    card.classList.add("card", "mb-3", "col-md-3", "d-flex", "flex-column"); // Apply Bootstrap grid classes and flex column layout

    // Create card body
    const cardBody = document.createElement("div");
    cardBody.classList.add("card-body");

    // Display date with smaller font size
    const dateElement = document.createElement("p");
    dateElement.classList.add("update-date");
    dateElement.innerText = `Date: ${update.date}`;
    dateElement.style.fontSize = "12px"; // Adjust the font size as needed
    cardBody.appendChild(dateElement);

    // Display picture (if provided)
    if (update.picture) {
        const pictureElement = document.createElement("img");
        pictureElement.src = update.picture;
        pictureElement.alt = "Beneficiary's Picture";
        pictureElement.classList.add("img-thumbnail"); // Add Bootstrap class for a smaller image
        cardBody.appendChild(pictureElement);
    }

    // Display title with scrollable container
    const titleContainer = document.createElement("div");
    titleContainer.classList.add("update-title-container");
    titleContainer.style.maxHeight = "100px"; // Adjust the height as needed
    titleContainer.style.overflowY = "auto";
    const titleElement = document.createElement("p");
    titleElement.classList.add("update-title");
    titleElement.innerText = update.title;
    titleContainer.appendChild(titleElement);
    cardBody.appendChild(titleContainer);

    // Create card footer for edit button
    const cardFooter = document.createElement("div");
    cardFooter.classList.add("card-footer", "mt-auto", "d-flex", "justify-content-end", "align-items-center");

    // Create edit button with Bootstrap modal attributes
    const editButton = document.createElement("button");
    editButton.classList.add("btn", "btn-pink", "edit-update");
    editButton.innerHTML = '<i class="fa-solid fa-pen-to-square fa-lg" style="color: #58c0e2"></i>';

    // Add Bootstrap modal attributes to the "Edit" button
    editButton.setAttribute("data-bs-toggle", "modal");
    editButton.setAttribute("data-bs-target", "#editModal");

    // Attach the update data to the edit button as a dataset attribute
    editButton.dataset.updateId = update.id;

    editButton.addEventListener("click", () => {
        // Implement edit functionality here
        const editUpdateId = editButton.dataset.updateId;
        const selectedUpdate = updates.find((update) => update.id == editUpdateId);

        // Populate the edit modal with the selected update's data
        document.getElementById("edit-date").value = selectedUpdate.date;
        document.getElementById("edit-title").value = selectedUpdate.title;
        // You can handle the picture editing here as well
    });

    // Append edit button to the card footer
    cardFooter.appendChild(editButton);

    // Append card body and card footer to the card
    card.appendChild(cardBody);
    card.appendChild(cardFooter);

    return card;
}

// Function to display updates as cards
function displayUpdates() {
    const updateDetails = document.getElementById("update-details");

    // Clear existing update cards
    updateDetails.innerHTML = "";

    // Loop through updates and create cards
    updates.forEach((update) => {
        const updateCard = createUpdateCard(update);
        updateDetails.appendChild(updateCard);
    });
}

// Call the displayUpdates function initially to populate the update cards
displayUpdates();

// Rest of your code remains unchanged...

        // Add update functionality
        const updateForm = document.getElementById("update-form");
        updateForm.addEventListener("submit", function(e) {
            e.preventDefault();

            const date = document.getElementById("date").value;
            const picture = document.getElementById("picture").files[0];
            const title = document.getElementById("title").value;

            if (!date || !title) {
                alert("Please fill in all fields.");
                return;
            }


        });
    </script>

<script>
    //OPEN PICTURE 
// Display picture (if provided)
if (update.picture) {
    const pictureElement = document.createElement("img");
    pictureElement.src = update.picture;
    pictureElement.alt = "Beneficiary's Picture";
    pictureElement.classList.add("img-thumbnail"); // Add Bootstrap class for a smaller image

    // Add click event to open the image in a modal
    pictureElement.addEventListener("click", () => {
        displayImageInModal(update.picture);
    });

    cardBody.appendChild(pictureElement);
}

// Function to display the image in a modal
function displayImageInModal(imageURL) {
    const modalBody = document.createElement("div");
    modalBody.classList.add("modal-body");

    const modalContent = document.createElement("div");
    modalContent.classList.add("modal-content");

    const modalImage = document.createElement("img");
    modalImage.src = imageURL;
    modalImage.alt = "Beneficiary's Picture";

    modalBody.appendChild(modalImage);
    modalContent.appendChild(modalBody);

    // Open Bootstrap modal
    const modal = new bootstrap.Modal(document.getElementById("imageModal"));
    modal.show();

    // Append the modal content to the modal dialog
    const modalDialog = document.getElementById("imageModalDialog");
    modalDialog.innerHTML = '';
    modalDialog.appendChild(modalContent);
}

    </script>

    <script>
        //DROP IMAGE
        const dropImg = document.getElementById("drop-img");
        const inputFile = document.getElementById("edit-picture");
        const imgView = document.getElementById("img-view");

        inputFile.addEventListener("change", uploadImage);

        function uploadImage() {
            let imgLink = URL.createObjectURL(inputFile.files[0]);
            imgView.style.backgroundImage = `url(${imgLink})`;
            imgView.textContent = "";
        }

        dropImg.addEventListener("dragover", function(e) {
            e.preventDefault();
        });
        dropImg.addEventListener("drop", function(e) {
            e.preventDefault();
            inputFile.files = e.dataTransfer.files;
            uploadImage();
        });

        // Function to open the schedule modal
        function openScheduleModal() {
            // Add your code to open the schedule modal here
            alert("Add Schedule button clicked!");
        }

        // Add an event listener to the "Add Schedule" button
        const addScheduleButton = document.getElementById("add-schedule-button");
        addScheduleButton.addEventListener("click", openScheduleModal);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const progressChart = document.getElementById("chart-fill");
            const progressNum = document.getElementById("progress-num");

            // Function to update the chart based on the selected progress number
            function updateChart(selectedPercent) {
                const percent = selectedPercent;
                progressChart.style.height = percent + "%";
            }

            // Add a click event listener to each progress number
            const progressNumbers = progressNum.getElementsByTagName("li");
            for (const number of progressNumbers) {
                number.addEventListener("click", function() {
                    const selectedPercent = parseInt(number.getAttribute("data-percent"));
                    updateChart(selectedPercent);
                });
            }
        });
    </script>

    {{-- <script>
        //PROGRESS BAB
        const one = document.querySelector(".one");

        const two = document.querySelector(".two");

        const three = document.querySelector(".three");

        const four = document.querySelector(".four");

        const five = document.querySelector(".five");


        one.onclick = function() {

            one.classList.add("active");

            two.classList.remove("active");

            three.classList.remove("active");

            four.classList.remove("active");

            five.classList.remove("active");

        }


        two.onclick = function() {

            one.classList.add("active");

            two.classList.add("active");

            three.classList.remove("active");

            four.classList.remove("active");

            five.classList.remove("active");

        }

        three.onclick = function() {

            one.classList.add("active");

            two.classList.add("active");

            three.classList.add("active");

            four.classList.remove("active");

            five.classList.remove("active");

        }

        four.onclick = function() {

            one.classList.add("active");

            two.classList.add("active");

            three.classList.add("active");

            four.classList.add("active");

            five.classList.remove("active");

        }

        five.onclick = function() {

            one.classList.add("active");

            two.classList.add("active");

            three.classList.add("active");

            four.classList.add("active");

            five.classList.add("active");

        }
    </script> --}}

    <script>
        let circularProgress = document.querySelector(".chart"),
            progressValue = document.querySelector(".progress-value");

        let progressStartValue = 0,
            progressEndValue = 0,
            speed = 20;

        // Set progressEndValue based on the user's assistance_status_name
        switch ("{{ $userAssistanceStatus }}") {
            case "started":
                progressEndValue = 26;
                break;
            case "pending":
                progressEndValue = 51;
                break;
            case "approved":
                progressEndValue = 76;
                break;
            case "disbursed":
                progressEndValue = 101;
                break;
            default:
                progressEndValue = 0;
        }

        let progress = setInterval(() => {
            

            circularProgress.style.background = `conic-gradient(#f0a60f ${progressStartValue * 3.6}deg, #f2f2f2 0deg)`
            progressValue.textContent = `${progressStartValue}%`;

            progressStartValue++;

            if(progressStartValue == progressEndValue || "{{ $userAssistanceStatus }}" == "unsettled") {
                clearInterval(progress);
            }
            
        }, speed);
    </script>
    <!--
    <script>
        //PROGRESS TRACKER
        const allItems = document.querySelectorAll(".navmenu ul li a");
        allItems.forEach(item => {

            item.addEventListener("click", function(e) {

                // Here we will write loop remove all prevois classes active

                for (var i = 0; i < allItems.length; i++) {

                    allItems[i].classList.remove("active");

                }

                this.classList.add("active");

            });

        });
    </script>
-->

</body>

</html>
