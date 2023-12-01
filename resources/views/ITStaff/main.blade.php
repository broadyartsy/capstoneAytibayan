<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>IT Staff</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Table -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- CSS link -->
    <link rel="stylesheet" href="{{ asset('Assets/css/itstaff.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script src="https://kit.fontawesome.com/6297197d39.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="icon" href="\images\APAO logo.png" type="image icon">
    
</head>

<body class="announcement_events_inquiry">

    @yield('content')
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <!-- Table -->
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>    
    <script src="{{ asset('Assets/js/itstaff.js') }}"></script>
    
    <script>
    //DROP IMAGE
    const dropImg = document.getElementById("drop-img");
const inputFile = document.getElementById("input-file");
const imgView = document.getElementById("img-view");

inputFile.addEventListener("change", uploadImage);

function uploadImage(){
    let imgLink = URL.createObjectURL(inputFile.files[0]);
    imgView.style.backgroundImage = `url(${imgLink})`;
    imgView.textContent ="";
}

dropImg.addEventListener("dragover", function(e){
    e.preventDefault();
});
dropImg.addEventListener("drop", function(e){
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

                
        
    prevPageButton.addEventListener('click', function () {
        if (currentPage > 1) {
            const currentButton = document.querySelector(`#page-numbers button:nth-child(${currentPage})`);
            if (currentButton) {
                currentButton.classList.remove('current-page');
            }

        currentPage--;
        displayRows();
        updatePagination();
        updatePaginationMessage();

        const pageButton = document.querySelector(`#page-numbers button:nth-child(${currentPage})`);
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

nextPageButton.addEventListener('click', function () {
    const totalPages = Math.ceil(rows.length / itemsPerPage);
    if (currentPage < totalPages) {
        const currentButton = document.querySelector(`#page-numbers button:nth-child(${currentPage})`);
        if (currentButton) {
            currentButton.classList.remove('current-page');
        }

        currentPage++;
        displayRows();
        updatePagination();
        updatePaginationMessage();

        const pageButton = document.querySelector(`#page-numbers button:nth-child(${currentPage})`);
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
     // Disable the "Next" button when there is no more data
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

        pageButton.addEventListener('click', function () {
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
// EDIT
function populateEditForm(existingData) {
    document.getElementById('EditTitle').value = existingData.title;
    document.getElementById('EditTo').value = existingData.email;
    document.getElementById('EditMessage').value = existingData.message;
}

// JavaScript to save the edits
function saveEdit() {
    const editedTitle = document.getElementById('EditTitle').value;
    const editedTo = document.getElementById('EditTo').value;
    const editedMessage = document.getElementById('EditMessage').value;

    // Perform your update logic here with the edited data
    // You may use AJAX to send the updated data to the server
}
</script>


       <script>
        //IEW
        function viewAnnouncement(id) {
            const messageContainer = document.querySelector(`.announcement:nth-child(${id}) .message`);
            messageContainer.style.display = messageContainer.style.display === "none" ? "block" : "none";
        }
    </script>
    
    <script>
        // Function to toggle the display of announcement details
        function viewAnnouncement(id) {
            const messageContainer = document.querySelector(`.announcement:nth-child(${id}) .message`);
            messageContainer.style.display = messageContainer.style.display === "none" ? "block" : "none";
        }

        // Function to delete an announcement row
        function deleteAnnouncement(id) {
            // Remove the row with the corresponding ID
            const row = document.querySelector(`tbody tr:nth-child(${id})`);
            if (row) {
                row.remove();
            }
        }
    </script>

<script>
//FILTER IN EVENT
$(document).ready(function() {
    $('#unread-filter').change(function() {
        var filterValue = $(this).val().toLowerCase();
        if (filterValue === 'all') {
            $('.table tbody tr').show();
        } else {
            $('.table tbody tr').hide();
            $('.table tbody tr').each(function() {
                var from = $(this).find('td:nth-child(1)').text().toLowerCase();
                var title = $(this).find('td:nth-child(2)').text().toLowerCase();
                var to = $(this).find('td:nth-child(3)').text().toLowerCase();
                var description = $(this).find('td:nth-child(4)').text().toLowerCase();
                var image = $(this).find('td:nth-child(5)').text().toLowerCase();
                var date = $(this).find('td:nth-child(6)').text().toLowerCase();

                if (
                    from.includes(filterValue) ||
                    title.includes(filterValue) ||
                    to.includes(filterValue) ||
                    description.includes(filterValue) ||
                    image.includes(filterValue) ||
                    date.includes(filterValue)
                ) {
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
        //
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

    // Search functionality
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

</body>
</html>