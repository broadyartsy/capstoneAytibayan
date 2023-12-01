
const body = document.querySelector("body"),
      modeToggle = body.querySelector(".mode-toggle");
      sidebar = body.querySelector("nav");
      sidebarToggle = body.querySelector(".sidebar-toggle");

let getMode = localStorage.getItem("mode");
if(getMode && getMode ==="dark"){
    body.classList.toggle("dark");
}

let getStatus = localStorage.getItem("status");
if(getStatus && getStatus ==="close"){
    sidebar.classList.toggle("close");
}

modeToggle.addEventListener("click", () =>{
    body.classList.toggle("dark");
    if(body.classList.contains("dark")){
        localStorage.setItem("mode", "dark");
    }else{
        localStorage.setItem("mode", "light");
    }
});

sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
    if(sidebar.classList.contains("close")){
        localStorage.setItem("status", "close");
    }else{
        localStorage.setItem("status", "open");
    }
})

function toggleNav() {
    const nav = document.querySelector('nav');
    nav.classList.toggle('open');
}
$(document).ready(function() {
    // Hide the name and submenus initially
    $(".sub-menus").hide();

    // Add a click event handler to the image
    $("i img").click(function() {
        // Toggle the visibility of the name and submenus
        $(".sub-menus").toggle();
    });
    $(document).click(function(e) {
    if (!$(e.target).closest("i img").length) {
        // Check if the clicked element is not inside the notification icon
        $(".sub-menus").hide();
    }
});
});
const numbers = document.querySelectorAll('.number');

numbers.forEach(number => {
    const value = parseInt(number.textContent);
    
    if (value >= 1000) {
        number.classList.add('high');
    } else if (value >= 500) {
        number.classList.add('medium');
    } else {
        number.classList.add('low');
    }
});
let steps = [];

function updateProgressBar() {
    const progressBar = document.getElementById("progress-bar");
    const completedSteps = steps.filter(step => step.completed).length;
    const percent = (completedSteps / steps.length) * 100;
    progressBar.style.width = percent + "%";
}

function completeStep(stepIndex) {
    if (stepIndex >= 0 && stepIndex < steps.length) {
        steps[stepIndex].completed = true;
        updateProgressBar();
        renderSteps();
    }
}

function deleteStep(stepIndex) {
    if (stepIndex >= 0 && stepIndex < steps.length) {
        steps.splice(stepIndex, 1);
        renderSteps();
        updateProgressBar();
    }
}

function addStep() {
    const newStep = { description: '', completed: false };
    steps.push(newStep);
    renderSteps();
}

function renderSteps() {
    const stepsContainer = document.getElementById("steps-container");
    stepsContainer.innerHTML = '';

    steps.forEach((step, index) => {
        const stepDiv = document.createElement("div");
        stepDiv.classList.add("step");
        stepDiv.innerHTML = `
            <span>Step ${index + 1}:</span>
            <input type="text" class="step-description" placeholder="Enter description" value="${step.description}">
            <button class="complete-button">Done</button>
            <button class="delete-button">Delete</button>
        `;
        stepsContainer.appendChild(stepDiv);

        const descriptionInput = stepDiv.querySelector(".step-description");
        descriptionInput.addEventListener("input", (event) => {
            steps[index].description = event.target.value;
        });

        const completeButton = stepDiv.querySelector(".complete-button");
        completeButton.addEventListener("click", () => completeStep(index));

        const deleteButton = stepDiv.querySelector(".delete-button");
        deleteButton.addEventListener("click", () => deleteStep(index));

        if (step.completed) {
            descriptionInput.disabled = true;
            completeButton.disabled = true;
        }
    });
}

// Initialize the page with an initial step
addStep();

// Table

function openPopup(fullName, message, emailAddress, contactNumber, date) {
    const popup = document.getElementById("message-popup");
    const fullNameElement = document.getElementById("full-name");
    const messageContent = document.getElementById("message-content");
    const emailAddressElement = document.getElementById("email-address");
    const contactNumberElement = document.getElementById("contact-number");
    const dateElement = document.getElementById("date");

    // Set the details in the popup
    fullNameElement.textContent = fullName;
    messageContent.textContent = message;
    emailAddressElement.textContent = emailAddress;
    contactNumberElement.textContent = contactNumber;
    dateElement.textContent = date;

    // Show the popup
    popup.style.display = "block";

}
function closePopup() {
    var popup = document.querySelector('.popup');
    popup.style.display = 'none';
}

//DELETE BUTTON
function viewAnnouncement(id) {
    const messageContainer = document.querySelector(`.announcement:nth-child(${id}) .message`);
    messageContainer.style.display = messageContainer.style.display === "none" ? "block" : "none";
}

function deleteAnnouncement(id) {
    const row = document.querySelector(`tbody tr:nth-child(${id})`);
    if (row) {
        row.remove();
    }
}


    // Add an event listener to the "Add" button
    document.querySelector('#add-modal-button').addEventListener('click', function() {
        // Show the modal when the button is clicked
        var eventviewModal = new bootstrap.Modal(document.querySelector('#eventview'));
        eventviewModal.show();
    });


