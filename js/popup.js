//Function to toggle the popup visibility
function togglePopup() {
    var popupContainer = document.getElementById('RequestPopUp');
    if (popupContainer.style.display === 'none') {
        popupContainer.style.display = 'block';
    } else {
        popupContainer.style.display = 'none';
    }
}

// Attach event listener to the button
document.getElementById('requestButton').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    togglePopup(); // Toggle the popup visibility
});


