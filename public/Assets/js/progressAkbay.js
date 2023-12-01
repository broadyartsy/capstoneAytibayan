document.addEventListener("DOMContentLoaded", function () {
    const progressList = document.getElementById("progress-list");
    const addStepButton = document.getElementById("add-step");
    const progressPercent = document.getElementById("progress-percent");
    const progressNum = document.getElementById("progress-num"); // Get the progress number list

    // Reset button
    const resetStepsButton = document.getElementById("reset-steps");
    resetStepsButton.addEventListener("click", () => {
        // Reset progressData to default values
        progressData = [
            { description: "Description", done: false, date: getCurrentDate() },
            { description: "Description", done: false, date: getCurrentDate() },
            { description: "Description", done: false, date: getCurrentDate() },
        ];

        // Save progressData to localStorage
        localStorage.setItem('progressDataAkbay', JSON.stringify(progressData));

        // Reset input values and re-render progress
        renderProgress();
        updateProgress();
    });

    function getCurrentDate() {
        const currentDate = new Date();
        const year = currentDate.getFullYear();
        const month = String(currentDate.getMonth() + 1).padStart(2, '0');
        const day = String(currentDate.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }
  
    // Initialize progress array with default steps
    let progressData = JSON.parse(localStorage.getItem('progressDataAkbay')) || [
        { description: "Description", done: false, date: getCurrentDate() },
        { description: "Description", done: false, date: getCurrentDate() },
        { description: "Description", done: false, date: getCurrentDate() },
    ];
  
    // Function to update the progress percentage and progress line
    function updateProgress() {
      const totalSteps = progressData.length;
    
      // Calculate the overall progress percentage
      const completedSteps = progressData.filter((step) => step.done).length;
      const overallPercentage = Math.floor((completedSteps / totalSteps) * 100);
    
      // Calculate the color based on the overallPercentage
      const color = getColorForPercentage(overallPercentage);
    
      // Update the progress line width and color dynamically
      const progressLine = document.querySelector('.progress-line');
      progressLine.style.width = `${overallPercentage}%`;
      progressLine.style.backgroundColor = color;
    
      // Update the "Progress %" box
      const progressBox = document.querySelector(".box-3");
      if (progressBox) {
        progressBox.querySelector("h1").textContent = `Progress %`;
        progressBox.querySelector("p").textContent = `${overallPercentage}%`;
      }
      // Calculate the color based on the overallPercentage
      const green = `hsl(${overallPercentage}, 100%, 50%)`;
  
      // Update the progress bar gradient dynamically
      const progressBar = document.querySelector('.progress-bar');
      progressBar.style.background = `
          radial-gradient(closest-side, white 79%, transparent 80% 100%),
          conic-gradient(${green} ${overallPercentage}%, lightgray 0)
      `;
  
      // Set the background color of progress numbers based on step status
      progressData.forEach((step, index) => {
        const stepNum = document.querySelectorAll(".progress-number")[index];
        stepNum.style.backgroundColor = step.done ? color : 'lightgray';
      });

      // Save progressData to localStorage
        localStorage.setItem('progressDataAkbay', JSON.stringify(progressData));
    }

    //function for email notification
    function notifyBeneficiaries(description) {
      // Make an AJAX request to notify beneficiaries
      fetch('/ABAKA_ProjectCoordinator/notify-beneficiaries', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ description }),
      })
        .then(response => response.json())
        .then(data => {
          console.log('Notification sent:', data);
        })
        .catch(error => {
            console.error('Error sending notification:', error);

            // Check if the error is a JSON parsing error
            if (error instanceof SyntaxError && error.message.includes('Unexpected token')) {
                console.error('Invalid JSON response. Server returned:', error.message);
            } else {
                console.error('Unexpected error:', error);
            }
        });
    }
  
    // Function to calculate color based on percentage
    function getColorForPercentage(percentage) {
      if (percentage <= 25) {
        return 'red';
      } else if (percentage <= 50) {
        return 'orange';
      } else if (percentage <= 75) {
        return 'yellow';
      } else {
        return 'green';
      }
    }
    
  
    // Function to render the progress list
    function renderProgress() {
      progressList.innerHTML = "";
      progressNum.innerHTML = ""; // Clear existing step numbers
  
      progressData.forEach((step, index) => {
        const li = document.createElement("li");
        li.innerHTML = `
          <span class="step-number">${index + 1}</span> <!-- Display step number -->
          <input type="checkbox" ${step.done ? "checked" : ""} class="checkbox">
          <input type="text" class="step-description" value="${step.description}">
          <input type="date" class="step-date" value="${step.date || ''}">
          <div class="progress-bar">
            <div class="progress-fill" style="width: ${step.done ? '100%' : '0%'};"></div>
          </div>
          <div class="step-progress">
          </div>
          <button class="done-button" ${step.disabled ? 'disabled' : ''}>Save</button>
          <button class="edit-button"><i class="fas fa-edit"></i></button>
          <button class="delete-button"><i class="fas fa-trash-alt"></i></button>
        `;
  
        const checkbox = li.querySelector(".checkbox");
        const description = li.querySelector(".step-description");
        const dateInput = li.querySelector(".step-date");
            dateInput.value = step.date; // Set the date from progressData
        const icon = li.querySelector(".step-icon");
        const doneButton = li.querySelector(".done-button");
        const editButton = li.querySelector(".edit-button");
        const deleteButton = li.querySelector(".delete-button");
  
        // Checkbox click event handler
        checkbox.addEventListener("change", () => {
          progressData[index].done = checkbox.checked;
  
          // Update the progress line width for this specific step
          const fill = li.querySelector('.progress-fill');
          fill.style.width = checkbox.checked ? '100%' : '0%';
  
          // Recalculate the overall progress and update it
          updateProgress();
        });
  
        // Done button click event handler
        doneButton.addEventListener("click", () => {
          // Disable input elements
          checkbox.disabled = true;
          description.disabled = true;
          dateInput.disabled = true;
          progressData[index].description = description.value;
          
          // Disable the button
          doneButton.disabled = true;
          progressData[index].disabled = true;

          // Notify beneficiaries
          notifyBeneficiaries(description.value);
  
          // Toggle the 'save-button' class to make the button green
          doneButton.classList.toggle("save-button");

          // Update the progress line and percentage
          updateProgress();
        });
  
        // Edit button click event handler
        editButton.addEventListener("click", () => {
          description.removeAttribute("readonly");
          description.focus();

          // Remove the 'save-button' class to return the button to its original color
          doneButton.classList.remove("save-button");

          // Re-enable input elements
          checkbox.disabled = false;
          description.disabled = false;
          dateInput.disabled = false;
        });
  
        // Delete button click event handler
        deleteButton.addEventListener("click", () => {
          progressData.splice(index, 1);
          renderProgress();
          updateProgress();
          deleteStep(index);
        });
  
        progressList.appendChild(li);
  
        // Dynamically generate step numbers in the progress number list
        const stepNum = document.createElement("li");
        stepNum.textContent = index + 1;
        stepNum.classList.add("progress-number");
        progressNum.appendChild(stepNum);
      });
    }

    
  
    // Initial rendering
    renderProgress();
    updateProgress();
  
    // Add Step button click event handler
    addStepButton.addEventListener("click", () => {
      const description = "Description";
      progressData.push({ description, done: false, date: getCurrentDate() });
      renderProgress();
      updateProgress();
    });
  });
  