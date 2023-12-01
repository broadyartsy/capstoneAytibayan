<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Project Coordinator</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Table -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- CSS link -->
    <link rel="stylesheet" href="{{ asset('Assets/css/coordinator.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/css/binhi-print.css') }}" media="print">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script src="https://kit.fontawesome.com/6297197d39.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="icon" href="\images\APAO logo.png" type="image icon">
</head>

<body class="announcement_events_inquiry">

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function(){
            $(document).on('click', '#blacklist',function(e){
                e.preventDefault();
                var link = $(this).attr("href");

                                    Swal.fire({
                                        title: '<span style="color: black;">Are you sure?</span>',
                                        text: "Add this user to Blacklist?",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#7bb701',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, add to Blacklist!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            window.location.href = link
                                            Swal.fire(
                                                'Done',
                                                'User has been Blacklisted.',
                                                'success'
                                            )
                                        }
                                    })
            });
        });

        $(function(){
    $(document).on('click', '#restore',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

                            Swal.fire({
                                title: '<span style="color: black;">Are you sure?</span>',
                                text: "Remove this user from Blacklist?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#7bb701',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, restore user!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = link
                                    Swal.fire(
                                        'Done',
                                        'User has been restored.',
                                        'success'
                                    )
                                }
                            })
    });
});
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- Table -->
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('Assets/js/coordinator.js') }}"></script>

    <script>
        //DROP IMAGE
        const dropImg = document.getElementById("drop-img");
        const inputFile = document.getElementById("input-file");
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
    </script>


    <script>
        //POP UP
        function toggleStatus(button) {
            const row = button.parentNode.parentNode;
            const statusBox = row.querySelector('.status-box');
            const statusPopup = document.getElementById('statusPopup');
            const beneficiaryName = row.querySelector('td:nth-child(2)').textContent;

            if (statusBox.classList.contains('active')) {
                statusBox.classList.remove('active');
                statusBox.classList.add('inactive');
                statusBox.textContent = 'Inactive';
                statusBox.style.backgroundColor = 'red';
                statusPopup.textContent = beneficiaryName + ' is now Inactive';
            } else {
                statusBox.classList.remove('inactive');
                statusBox.classList.add('active');
                statusBox.textContent = 'Active';
                statusBox.style.backgroundColor = 'green';
                statusPopup.textContent = beneficiaryName + ' is now Active';
            }

            statusPopup.style.display = 'block';
            setTimeout(() => {
                statusPopup.style.display = 'none';
            }, 2000);
        }
    </script>

    <script>
        // JavaScript for pagination
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.querySelector('.table');
            const rows = table.querySelectorAll('tbody tr');
            const itemsPerPageSelect = document.getElementById('items-per-page');
            const prevPageButton = document.getElementById('prev-page');
            const nextPageButton = document.getElementById('next-page');
            let currentPage = 1;
            let itemsPerPage = parseInt(itemsPerPageSelect.value);

            function updatePagination() {
                const totalPages = Math.ceil(rows.length / itemsPerPage);
                if (currentPage === 1) {
                    prevPageButton.disabled = true;
                } else {
                    prevPageButton.disabled = false;
                }
                if (currentPage === totalPages) {
                    nextPageButton.disabled = true;
                } else {
                    nextPageButton.disabled = false;
                }
            }

            function displayRows() {
                const startIdx = (currentPage - 1) * itemsPerPage;
                const endIdx = startIdx + itemsPerPage;

                rows.forEach((row, index) => {
                    if (index >= startIdx && index < endIdx) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            itemsPerPageSelect.addEventListener('change', function() {
                const selectedValue = itemsPerPageSelect.value;
                if (selectedValue === 'all') {
                    itemsPerPage = rows.length;
                } else {
                    itemsPerPage = parseInt(selectedValue);
                }
                currentPage = 1;
                displayRows();
                updatePagination();
                updatePaginationMessage();
            });



            prevPageButton.addEventListener('click', function() {
                if (currentPage > 1) {
                    const currentButton = document.querySelector(
                        `#page-numbers button:nth-child(${currentPage})`);
                    if (currentButton) {
                        currentButton.classList.remove('current-page');
                    }

                    currentPage--;
                    displayRows();
                    updatePagination();
                    updatePaginationMessage();

                    const pageButton = document.querySelector(
                        `#page-numbers button:nth-child(${currentPage})`);
                    if (pageButton) {
                        pageButton.classList.add('current-page');
                    }

                    // Disable the "Next" button if we are on the first page
                    if (currentPage === 1) {
                        prevPageButton.disabled = true;
                        prevPageButton.classList.add('disabled');
                    }

                    // Enable the "Next" button
                    nextPageButton.disabled = false;
                    nextPageButton.classList.remove('disabled');
                }
            });

            nextPageButton.addEventListener('click', function() {
                const totalPages = Math.ceil(rows.length / itemsPerPage);
                if (currentPage < totalPages) {
                    const currentButton = document.querySelector(
                        `#page-numbers button:nth-child(${currentPage})`);
                    if (currentButton) {
                        currentButton.classList.remove('current-page');
                    }

                    currentPage++;
                    displayRows();
                    updatePagination();
                    updatePaginationMessage();

                    const pageButton = document.querySelector(
                        `#page-numbers button:nth-child(${currentPage})`);
                    if (pageButton) {
                        pageButton.classList.add('current-page');
                    }

                    // Disable the "Previous" button if we are on the last page
                    if (currentPage === totalPages) {
                        nextPageButton.disabled = true;
                        nextPageButton.classList.add('disabled');
                    }

                    // Enable the "Previous" button
                    prevPageButton.disabled = false;
                    prevPageButton.classList.remove('disabled');
                }
            });

            function updatePaginationMessage() {
                const totalPages = Math.ceil(rows.length / itemsPerPage);
                const startIndex = (currentPage - 1) * itemsPerPage + 1;
                const endIndex = Math.min(currentPage * itemsPerPage, rows.length);
                const entriesCount = rows.length;

                let message;

                if (itemsPerPage === rows.length) {
                    message = `Showing all ${entriesCount} entries`;
                } else {
                    if (endIndex > entriesCount) {
                        message = `Showing ${startIndex}-${entriesCount} of ${entriesCount} entries`;
                    } else {
                        message = `Showing ${startIndex}-${endIndex} of ${entriesCount} entries`;
                    }
                }

                document.getElementById('pagination-message').textContent = message;
            }





            function updatePaginationButtons() {
                const totalPages = Math.ceil(rows.length / itemsPerPage);

                // Clear the page numbers div
                const pageNumbersDiv = document.getElementById('page-numbers');
                pageNumbersDiv.innerHTML = '';

                // Create and append page number buttons
                for (let page = 1; page <= totalPages; page++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = page;

                    if (page === currentPage) {
                        // Highlight the current page button
                        pageButton.classList.add('current-page');
                    }

                    pageButton.addEventListener('click', function() {
                        if (page !== currentPage) {
                            // Only update if the clicked page is different from the current page
                            // Remove the highlight from the current page button
                            const currentButton = pageNumbersDiv.querySelector('.current-page');
                            if (currentButton) {
                                currentButton.classList.remove('current-page');
                            }

                            // Update the current page and re-render the table
                            currentPage = page;
                            displayRows();
                            updatePagination();
                            updatePaginationMessage();

                            // Highlight the clicked page button
                            pageButton.classList.add('current-page');
                        }
                    });

                    pageNumbersDiv.appendChild(pageButton);
                }
            }

            // Initialize pagination buttons
            updatePaginationButtons();
            // Update the pagination message initially
            updatePaginationMessage();

            // Initialize pagination
            displayRows();
            updatePagination();
        });
    </script>

    <script>
        //VIEW MODAL
        $(document).ready(function() {
            $(".view-btn").on("click", function() {
                // Get the row index from the clicked button's data attribute
                var rowIndex = $(this).data("row-index");

                // Find the row in the table and extract its data
                var $table = $("table");
                var $row = $table.find("tbody tr:eq(" + rowIndex + ")");
                var title = $row.find("td:eq(0)").text();
                var recipient = $row.find("td:eq(1)").text();
                var message = "The message goes here"; // You can populate the message as needed

                // Populate the modal with the extracted data
                $("#modal-title").text(title);
                $("#modal-recipient").text(recipient);
                $("#modal-message").text(message);

                // Show the modal
                $("#modal_view").modal("show");
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        //EDIT
        // Store the initial data from the table row
        var initialData = {
            title: "",
            recipient: "",
            message: ""
        };

        $(document).ready(function() {
            $(".view-btn").on("click", function() {
                // Get the row index from the clicked button's data attribute
                var rowIndex = $(this).data("row-index");

                // Find the row in the table and extract its data
                var $table = $("table");
                var $row = $table.find("tbody tr:eq(" + rowIndex + ")");
                initialData.title = $row.find("td:eq(0)").text();
                initialData.recipient = $row.find("td:eq(1)").text();
                initialData.message = "The message goes here"; // You can populate the message as needed

                // Populate the modal form fields with the extracted data
                $("#edit-title").val(initialData.title);
                $("#edit-recipient").val(initialData.recipient);
                $("#edit-message").val(initialData.message);

                // Show the modal
                $("#myModal").modal("show");
            });

            // Handle the "Save Changes" button click
            $("#saveChanges").on("click", function() {
                // Get the edited values from the form
                var editedTitle = $("#edit-title").val();
                var editedRecipient = $("#edit-recipient").val();
                var editedMessage = $("#edit-message").val();

                // Update the corresponding elements in the table with the edited values
                // This step depends on your specific implementation and requirements

                // Optionally, you can update the initialData to reflect the changes
                initialData.title = editedTitle;
                initialData.recipient = editedRecipient;
                initialData.message = editedMessage;
            });
        });
    </script>

    <script>
        // JavaScript for pagination
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.querySelector('.table');
            const rows = table.querySelectorAll('tbody tr');
            const itemsPerPageSelect = document.getElementById('items-per-page');
            const prevPageButton = document.getElementById('prev-page');
            const nextPageButton = document.getElementById('next-page');
            let currentPage = 1;
            let itemsPerPage = parseInt(itemsPerPageSelect.value);

            function updatePagination() {
                const totalPages = Math.ceil(rows.length / itemsPerPage);
                if (currentPage === 1) {
                    prevPageButton.disabled = true;
                } else {
                    prevPageButton.disabled = false;
                }
                if (currentPage === totalPages) {
                    nextPageButton.disabled = true;
                } else {
                    nextPageButton.disabled = false;
                }
            }

            function displayRows() {
                const startIdx = (currentPage - 1) * itemsPerPage;
                const endIdx = startIdx + itemsPerPage;

                rows.forEach((row, index) => {
                    if (index >= startIdx && index < endIdx) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            itemsPerPageSelect.addEventListener('change', function() {
                const selectedValue = itemsPerPageSelect.value;
                if (selectedValue === 'all') {
                    itemsPerPage = rows.length;
                } else {
                    itemsPerPage = parseInt(selectedValue);
                }
                currentPage = 1;
                displayRows();
                updatePagination();
                updatePaginationMessage();
            });



            prevPageButton.addEventListener('click', function() {
                if (currentPage > 1) {
                    const currentButton = document.querySelector(
                        `#page-numbers button:nth-child(${currentPage})`);
                    if (currentButton) {
                        currentButton.classList.remove('current-page');
                    }

                    currentPage--;
                    displayRows();
                    updatePagination();
                    updatePaginationMessage();

                    const pageButton = document.querySelector(
                        `#page-numbers button:nth-child(${currentPage})`);
                    if (pageButton) {
                        pageButton.classList.add('current-page');
                    }

                    // Disable the "Next" button if we are on the first page
                    if (currentPage === 1) {
                        prevPageButton.disabled = true;
                        prevPageButton.classList.add('disabled');
                    }

                    // Enable the "Next" button
                    nextPageButton.disabled = false;
                    nextPageButton.classList.remove('disabled');
                }
            });

            nextPageButton.addEventListener('click', function() {
                const totalPages = Math.ceil(rows.length / itemsPerPage);
                if (currentPage < totalPages) {
                    const currentButton = document.querySelector(
                        `#page-numbers button:nth-child(${currentPage})`);
                    if (currentButton) {
                        currentButton.classList.remove('current-page');
                    }

                    currentPage++;
                    displayRows();
                    updatePagination();
                    updatePaginationMessage();

                    const pageButton = document.querySelector(
                        `#page-numbers button:nth-child(${currentPage})`);
                    if (pageButton) {
                        pageButton.classList.add('current-page');
                    }

                    // Disable the "Previous" button if we are on the last page
                    if (currentPage === totalPages) {
                        nextPageButton.disabled = true;
                        nextPageButton.classList.add('disabled');
                    }

                    // Enable the "Previous" button
                    prevPageButton.disabled = false;
                    prevPageButton.classList.remove('disabled');
                }
                if (currentPage >= totalPages) {
                    nextPageButton.disabled = true;
                    nextPageButton.classList.add('disabled');
                }
            });

            function updatePaginationMessage() {
                const totalPages = Math.ceil(rows.length / itemsPerPage);
                const startIndex = (currentPage - 1) * itemsPerPage + 1;
                const endIndex = Math.min(currentPage * itemsPerPage, rows.length);
                const entriesCount = rows.length;

                let message;

                if (itemsPerPage === rows.length) {
                    message = `Showing all ${entriesCount} entries`;
                } else {
                    if (endIndex > entriesCount) {
                        message = `Showing ${startIndex}-${entriesCount} of ${entriesCount} entries`;
                    } else {
                        message = `Showing ${startIndex}-${endIndex} of ${entriesCount} entries`;
                    }
                }

                document.getElementById('pagination-message').textContent = message;
            }





            function updatePaginationButtons() {
                const totalPages = Math.ceil(rows.length / itemsPerPage);

                // Clear the page numbers div
                const pageNumbersDiv = document.getElementById('page-numbers');
                pageNumbersDiv.innerHTML = '';

                // Create and append page number buttons
                for (let page = 1; page <= totalPages; page++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = page;

                    if (page === currentPage) {
                        // Highlight the current page button
                        pageButton.classList.add('current-page');
                    }

                    pageButton.addEventListener('click', function() {
                        if (page !== currentPage) {
                            // Only update if the clicked page is different from the current page
                            // Remove the highlight from the current page button
                            const currentButton = pageNumbersDiv.querySelector('.current-page');
                            if (currentButton) {
                                currentButton.classList.remove('current-page');
                            }

                            // Update the current page and re-render the table
                            currentPage = page;
                            displayRows();
                            updatePagination();
                            updatePaginationMessage();

                            // Highlight the clicked page button
                            pageButton.classList.add('current-page');
                        }
                    });

                    pageNumbersDiv.appendChild(pageButton);
                }
            }

            // Initialize pagination buttons
            updatePaginationButtons();
            // Update the pagination message initially
            updatePaginationMessage();

            // Initialize pagination
            displayRows();
            updatePagination();
        });
    </script>

    <script>
        // Function to update the beneficiary name in the "Beneficiary Updates" modal
        function setBeneficiaryName(name) {
            const beneficiaryNameElement = document.getElementById("actual-beneficiary-name");
            beneficiaryNameElement.textContent = name;
        }

        // Example code to open the modal and set the beneficiary name
        const beneficiaryName = "Orly Encabo"; // Replace with the actual beneficiary name
        setBeneficiaryName(beneficiaryName);



        // Existing updates data
        const updates = [{
                id: 1,
                date: '2023-09-22',
                picture: '/images/agri1.png',
                title: 'Update 1 title here.',
            },
            {
                id: 2,
                date: '2023-09-23',
                picture: '/images/agri2.png',
                title: 'Update 2 title here.',
            },
            {
                id: 3,
                date: '2023-09-23',
                picture: '/images/agri3.png',
                title: 'Update 3 title here.',
            },
            {
                id: 4,
                date: '2023-09-23',
                picture: '/images/agri4.png',
                title: 'Update 4 title here.',
            },
        ];

        // Array to store schedule items
        const scheduleItems = [];

        // Function to create a schedule item
        function createScheduleItem(description, date, time) {
            return {
                description,
                date,
                time,
            };
        }

        // Function to display schedule items
        function displayScheduleItems() {
            const scheduleList = document.getElementById("schedule-list");
            scheduleList.innerHTML = "";

            scheduleItems.forEach((item, index) => {
                const listItem = document.createElement("li");
                listItem.className = "list-group-item";
                listItem.innerHTML =
                    `<strong>${item.description}</strong><br>Date: ${item.date}<br>Time: ${item.time}`;
                scheduleList.appendChild(listItem);
            });
        }

        /// Handle Add Schedule button click event
        // ...

        // Handle Add Schedule button click event
        const addScheduleButton = document.getElementById("add-schedule-button");
        addScheduleButton.addEventListener("click", function() {
            // Clear the form fields in the Add Schedule Modal
            document.getElementById("schedule-description").value = "";
            document.getElementById("schedule-date").value = "";
            document.getElementById("schedule-time").value = "";

            // Show the Add Schedule Modal
            const addScheduleModal = new bootstrap.Modal(document.getElementById("add-schedule-modal"));
            addScheduleModal.show();
        });

        // Handle Save Schedule button click event
        const saveScheduleButton = document.getElementById("save-schedule-button");
        saveScheduleButton.addEventListener("click", function() {
            const beneficiaryName = document.getElementById("actual-beneficiary-name").textContent;
            const description = document.getElementById("schedule-description").value;
            const date = document.getElementById("schedule-date").value;
            const time = document.getElementById("schedule-time").value;

            if (!description || !date || !time) {
                alert("Please fill in all fields.");
                return;
            }

            // Create a schedule item and add it to the array
            const scheduleItem = createScheduleItem(description, date, time);
            scheduleItems.push(scheduleItem);

            // Display schedule items
            displayScheduleItems();

            // Close the Add Schedule Modal
            const addScheduleModal = new bootstrap.Modal(document.getElementById("add-schedule-modal"));
            addScheduleModal.hide();
        });

        // ...


        // Function to create an update card
        function createUpdateCard(update) {
            const card = document.createElement("div");
            card.classList.add("card", "mb-3", "col-md-3"); // Apply Bootstrap grid classes

            // Create card body
            const cardBody = document.createElement("div");
            cardBody.classList.add("card-body");

            // Display date
            const dateElement = document.createElement("p");
            dateElement.classList.add("update-date");
            dateElement.innerText = `Date: ${update.date}`;
            cardBody.appendChild(dateElement);

            // Display picture (if provided)
            if (update.picture) {
                const pictureElement = document.createElement("img");
                pictureElement.src = update.picture;
                pictureElement.alt = "Beneficiary's Picture";
                pictureElement.classList.add("img-thumbnail"); // Add Bootstrap class for a smaller image
                cardBody.appendChild(pictureElement);
            }

            // Display title (limited to 50 words)
            const titleElement = document.createElement("p");
            titleElement.classList.add("update-title");
            titleElement.innerText = `Title: ${update.title}`;
            cardBody.appendChild(titleElement);

            // Append card body to the card
            card.appendChild(cardBody);

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
    </script>

    <script>
        // VIEW EVENT

        const tableRows = document.querySelectorAll('table tbody tr');
        tableRows.forEach((row, index) => {
            row.addEventListener('click', () => {
                // Get data from the clicked row
                const rowData = Array.from(row.children).map((cell) => cell.textContent.trim());

                // Populate the view elements with data from the row
                document.getElementById('ViewTitle').textContent = rowData[0];
                document.getElementById('ViewDate').textContent = rowData[3];
                document.getElementById('ViewDescription').textContent = rowData[1];

                // You may need to handle the image separately based on how your data is structured
                // For example, if your image data is a filename like 'image.png':
                // document.getElementById('ViewImage').src = '/images/' + rowData[2];
            });
        });
    </script>

    <script>
        // VIEW ANNOUNCEMENT
        const tableRows = document.querySelectorAll('#dataTable tbody tr');
        tableRows.forEach((row, index) => {
            row.addEventListener('click', () => {

                const rowData = Array.from(row.children).map((cell) => cell.textContent.trim());

                document.getElementById('ViewTitle').textContent = rowData[0];
                document.getElementById('ViewTo').textContent = rowData[1];
                document.getElementById('ViewMessage').textContent = rowData[2];
                document.getElementById('ViewDate').textContent = rowData[3];
            });
        });
    </script>

    <script>
        function printTable() {
            window.print();
        }
    </script>

    <script>
        //PROGRESS SEARCH BAR
        const searchInput = document.getElementById("search");
        const table = document.getElementById("beneficiaries-table");
        const rows = table.getElementsByTagName("tr");

        searchInput.addEventListener("keyup", function() {
            coshowAddValuePopupnst searchValue = searchInput.value.toLowerCase();

            for (let i = 1; i < rows.length; i++) {
                const beneficiaryName = rows[i].getElementsByTagName("td")[1].textContent.toLowerCase();
                if (beneficiaryName.includes(searchValue)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        });
    </script>


    <script>
        // Function to show the "Add Value" popup
        function showAddValuePopup(beneficiaryId) {
            const addValuePopup = document.getElementById('add-value-popup-' + beneficiaryId);
            addValuePopup.style.display = "block";
        }

        // Function to hide the "Add Value" popup
        function hideAddValuePopup(beneficiaryId) {
            var addValuePopup = document.getElementById('add-value-popup-' + beneficiaryId);
            addValuePopup.style.display = "none";
        }

        // Function to handle the form submission
        document.getElementById("add-beneficiary-button").addEventListener("click", function(event) {
            event.preventDefault();
            var name = document.getElementById("name").value;
            var organization = document.getElementById("organization").value;
            var amount = document.getElementById("amount").value;

            // You can perform further actions with the form data here (e.g., send it to a server or update the UI).

            // Close the "Add Value" popup
            hideAddValuePopup();
        });

        function showUpdateStatusPopup(beneficiaryId) {
            const popup = document.getElementById('update-status-popup-' + beneficiaryId);
            popup.style.display = "block";
        }

        // Function to hide the update status popup
        function hideUpdateStatusPopup(beneficiaryId) {
            const popup = document.getElementById('update-status-popup-' + beneficiaryId);
            popup.style.display = "none";
        }

        // Add event listener to close the popup when the "Save" button is clicked
        document.getElementById('update-beneficiary-button').addEventListener('click', function() {
            // Perform actions when the Save button is clicked
            // You can handle form submission or other actions here

            // Close the popup
            hideUpdateStatusPopup();
        });
    </script>

    <script>
        //BENEFICIARY SEARCH BAR
        $(document).ready(function() {
            $('#search').on('input', function() {
                let value = $(this).val().toLowerCase();
                $('table tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>

    <script>
        //FILTER BENEFICIARY
        $(document).ready(function() {
    $('#status-filter').change(function() {
        var filterValue = $(this).val().toLowerCase();
        if (filterValue === 'all') {
            $('.table tbody tr').show();
        } else {
            $('.table tbody tr').hide();
            $('.table tbody tr').each(function() {
                var status = $(this).find('td:nth-child(8)').text().toLowerCase();
                if (status === filterValue) {
                    $(this).show();
                }
            });
        }
    });

    $('#search').on('keyup', function() {
        var searchText = $(this).val().toLowerCase();
        $('.table tbody tr').each(function() {
            var rowText = $(this).text().toLowerCase();
            if (rowText.indexOf(searchText) === -1) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });
});


    </script>

   <script>
$(document).ready(function() {
    $('#unread-filter').change(function() {
        var filterValue = $(this).val().toLowerCase();
        if (filterValue === 'all') {
            $('.table tbody tr').show();
        } else {
            $('.table tbody tr').hide();
            $('.table tbody tr').each(function() {
                $(this).find('td').each(function() {
                    if ($(this).text().toLowerCase() === filterValue) {
                        $(this).closest('tr').show();
                    }
                });
            });
        }
    });
});
    </script>
<script>

//LIMIT TEXT
document.addEventListener('DOMContentLoaded', function() {
  const messageCells = document.querySelectorAll('.message-cell');

  messageCells.forEach(cell => {
    cell.addEventListener('click', function() {
      const fullText = cell.textContent.trim();
      if (fullText.endsWith('...')) {
        // Show the full text in a pop-up (you can customize this, e.g., use a modal)
        alert(fullText);
      }
    });
  });
});
</script>

<script>
    //DELETE PROJECT
    function deleteProject(button) {
    if (confirm('Are you sure you want to delete this project?')) {
        // Assuming each box is a parent element of the delete button
        const box = button.closest('.box');
        // Perform deletion logic here, for example:
        box.remove(); 
    } else {
    }
}
    </script>

<script>// Add this script at the end of your Blade template or in a separate JS file.
document.addEventListener('DOMContentLoaded', function () {
    const viewButtons = document.querySelectorAll('.tooltip-button[data-tooltip="View"]');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const inquiryId = this.getAttribute('data-inquiry-id');

            // Make an AJAX request to mark the message as read
            fetch(`/BINHI_ProjectCoordinator/inquiry/mark-as-read/${inquiryId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            })
            .then(response => {
                if (response.ok) {
                    // Update the UI to remove the 'unread' class
                    this.closest('tr').classList.remove('unread');
                }
            })
            .catch(error => {
                console.error('Error marking message as read:', error);
            });
        });
    });
});

</script>
<!-------MEDIA PRINT---------->
<script>
  document.getElementById('printButton').addEventListener('click', function() {
    var printContents = document.getElementById('printableContent').innerHTML;
    var originalContents = document.body.innerHTML;

    var totalBeneficiaries = document.querySelectorAll('#beneficiaries-table tbody tr').length;

    printContents += '<div>Total Beneficiaries: ' + totalBeneficiaries + '</div>';

    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;

    // Reload the page after printing
    setTimeout(function() {
      location.reload();
    }, 1000); // Adjust the timeout value as needed
  });
</script>

<!----------STATUS FILTER------------>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const statusFilter = document.getElementById('status-filter');
  const tableRows = document.querySelectorAll('#beneficiaries-table tbody tr');

  statusFilter.addEventListener('change', function() {
    const selectedStatus = statusFilter.value;

    tableRows.forEach(row => {
      const statusCell = row.querySelector('td:nth-child(5)'); // Adjust index based on your table structure
      if (selectedStatus === 'all' || statusCell.textContent.toLowerCase().includes(selectedStatus)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
});
</script>
<script>//export
    document.addEventListener('DOMContentLoaded', function () {
        const exportButton = document.getElementById('exportButton');
        exportButton.addEventListener('click', exportTable);

        function exportTable() {
            const table = document.getElementById('beneficiaries-table');
            const rows = table.querySelectorAll('tbody tr');

            // Create a CSV string
            let csvContent = "User ID,Beneficiary,Barangay,City,Status,Project,Amount,Hectares,Assistance Status\n";

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const userId = cells[0].textContent.trim();
                const beneficiary = cells[1].textContent.replace(/\n/g, ' ').trim();
                const barangay = cells[2].textContent.trim();
                const city = cells[3].textContent.trim();
                const status = cells[4].textContent.trim();
                const project = cells[5].textContent.trim();
                const amount = cells[6].textContent.trim();
                const hectares = cells[7].textContent.trim();
                const assistanceStatus = cells[9].textContent.trim();

                const rowData = `${userId},${beneficiary},${barangay},${city},${status},${project},${amount},${hectares},${assistanceStatus}`;
                csvContent += rowData + '\n';
            });

            // Get the current date and time
            const options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit', hour12: true };
            const dateTime = new Date().toLocaleString('en-US', options).replace(/ /g, '_').replace(/:/g, ';');
            // Create a Blob and download the file with the date and time in the name
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const link = document.createElement('a');
            link.href = window.URL.createObjectURL(blob);
            link.download = `${dateTime}.csv`;
            link.click();
        }
    });
</script>



</body>

</html>
