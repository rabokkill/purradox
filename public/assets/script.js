// Today's Date
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth() + 1;
var yyyy = today.getFullYear();
var hh = today.getHours();
var min = today.getMinutes();
var ss = today.getSeconds();

// DATE
if(dd < 10){
    dd = '0' + dd;
}
if(mm < 10){
    mm = '0' + mm;
}
if(mm > 10){
    mm = mm;
}
// TIME
if (hh < 10) {
    hh = '0' + hh;
}
if (min < 10) {
    min = '0' + min;
}
if (ss < 10) {
    ss = '0' + ss;
}

// Format the date and time
var formattedDate = "Today's Date: " + mm + "/" + dd + "/" + yyyy;
var formattedTime = "Current Time: " + hh + ":" + min + ":" + ss;

// Display date and time
document.getElementById("today").innerHTML = formattedDate + "<br>" + formattedTime;

// CapsLock Warning
function checkCapsLock(event) {
    var capsLockWarning = document.getElementById('capsLockWarning');

    if (event.getModifierState("CapsLock")) {
        capsLockWarning.style.display = "inline";
    } else {
        capsLockWarning.style.display = "none";
    }
}

// Lowercase Input
function usernameValidation(input) {
    const errorMessage = document.getElementById("error-message");
    const originalValue = input.value;

    input.value = input.value.toLowerCase();
    input.value = input.value.replace(/[^a-z0-9_]/g, "");

    if (input.value !== originalValue) {
        errorMessage.style.display = "inline";
    } else {
        errorMessage.style.display = "none";
    }
}


// Capitalize First Letter
function capitalizeFirstLetter(input) {
    var value = input.value;
    input.value = value.charAt(0).toUpperCase() + value.slice(1).toLowerCase();
}

// Show Password
function viewPassword() {
    var x = document.getElementById("password");
    var y = document.getElementById("confirm_password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
    if (y.type === "password") {
        y.type = "text";
      } else {
        y.type = "password";
      }
}

function showModal() {
    var confirmAction = new bootstrap.Modal(document.getElementById('confirmAction'));
    confirmAction.show();
}

// const confirmAction = new bootstrap.Modal('#confirmAction');

// Job Listings
// function toggleMode(jobID) {
//     var editMode = document.getElementById('edit-mode-' + jobID);
//     var viewMode = document.getElementById('view-mode-' + jobID);

//     editMode.style.display = (editMode.style.display === "none" || editMode.style.display === "") ? "table-row" : "none";
//     viewMode.style.display = (viewMode.style.display === "none" || viewMode.style.display === "") ? "none" : "table-row";
// }

function toggleMode(jobID) {
    var editMode = document.getElementById('edit-mode-' + jobID);
    var viewMode = document.getElementById('view-mode-' + jobID);

    var isEditing = editMode.style.display === "table-row";

    editMode.style.display = isEditing ? "none" : "table-row";
    viewMode.style.display = isEditing ? "table-row" : "none";
}

// function toggleEdit() {
//     var cancelMode = document.getElementById('edit-mode');
//     var deleteMode = document.getElementById('view-mode');

//     cancelMode.style.display = (cancelMode.style.display === "none" || cancelMode.style.display === "") ? "none" : "block";
//     deleteMode.style.display = (deleteMode.style.display === "none" || deleteMode.style.display === "") ? "block" : "none";
// }

function toggleActionField(actionID) {
    var allActions = document.querySelectorAll('.toggle-form');
    var selectedAction = document.getElementById(actionID);
    var closeForm = document.getElementById('closeForm');
    
    allActions.forEach(function(field) {
        field.style.display = "none";
    });

    selectedAction.style.display = (selectedAction.style.display === "none" || selectedAction.style.display === "") ? "block" : "none";
    closeForm.style.display = selectedAction.style.display === "block" ? "none" : "none";
}

window.addEventListener('DOMContentLoaded', () => {
const feedbackModal = document.getElementById('feedbackModal');
if (feedbackModal) {
    const modal = new bootstrap.Modal(feedbackModal);
    modal.show();
}
});