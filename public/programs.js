let selectedProgramId = null;

function goBackToSelectionPage() {
    // Hide the key input textbox
    var keyInputBox = document.getElementById('keyInput');
    keyInputBox.style.display = 'none';

    // Show all program boxes
    var programBoxes = document.getElementsByClassName('box');
    for (var i = 0; i < programBoxes.length; i++) {
        programBoxes[i].style.display = 'block';
    }

    // Show the "Select" button for the previously selected program
    var selectedProgram = document.getElementById(selectedProgramId);
    if (selectedProgram) {
        var selectButton = selectedProgram.querySelector('button');
        selectButton.style.display = 'block';
    }

    // Clear the value of the key input
    var keyInput = document.getElementById('key');
    keyInput.value = '';
}

function selectProgram(programId) {
    // Hide all program boxes
    var programBoxes = document.getElementsByClassName('box');
    for (var i = 0; i < programBoxes.length; i++) {
        programBoxes[i].style.display = 'none';
    }

    // Show the selected program box
    var selectedProgram = document.getElementById(programId);
    selectedProgram.style.display = 'block';

    // Hide the "Select" button in the selected program box
    var selectButton = selectedProgram.querySelector('button');
    if (selectButton) {
        selectButton.style.display = 'none';
    }

    // Store the selected program ID
    selectedProgramId = programId;

    // Show the key input textbox
    var keyInputBox = document.getElementById('keyInput');
    keyInputBox.style.display = 'block';
}

function submitKey() {
    // Get the value of the key input
    var keyInput = document.getElementById('key').value;

    // TODO: You can add logic here to validate the key or perform any further actions

    // For now, let's just display an alert with the entered key
    alert("You entered the key: " + keyInput);

    // Go back to the selection page
    goBackToSelectionPage();
}