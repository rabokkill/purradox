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

// Feedback Modal
window.addEventListener('DOMContentLoaded', () => {
const feedbackModal = document.getElementById('feedbackModal');
if (feedbackModal) {
    const modal = new bootstrap.Modal(feedbackModal);
    modal.show();
}
});

// Confirmation Modal
let targetFormId = '';

const messageModal = document.getElementById('messageModal');
messageModal.addEventListener('show.bs.modal', function (event) {
    const button = event.relatedTarget;
    const message = button.getAttribute('data-message');
    targetFormId = button.getAttribute('data-form-id');

    const modalMessage = messageModal.querySelector('#modalMessage');
    modalMessage.textContent = message;
});

document.getElementById('confirmAction').addEventListener('click', function () {
    if (targetFormId) {
        document.getElementById(targetFormId).submit();
    }
});

function showModal() {
    var confirmAction = new bootstrap.Modal(document.getElementById('confirmAction'));
    confirmAction.show();
}