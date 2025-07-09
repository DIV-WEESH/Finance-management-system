// Function to validate phone number
function validatePhoneNumber(phoneNumber) {
    // Define a regular expression for validation
    const phoneRegex = /^(\+?[1-9]\d{0,3})?(\s)?\d{10}$/;

    // Test the phone number against the regex
    if (phoneRegex.test(phoneNumber)) {
        console.log("Phone number is valid.");
        return true; // Valid phone number
    } else {
        console.log("Invalid phone number.");
        return false; // Invalid phone number
    }
}

// Example usage
const phoneInput = document.getElementById("signup-phone");
const form = document.getElementById("signup-form");

form.addEventListener("submit", (e) => {
    e.preventDefault(); // Prevent form submission

    const phoneNumber = phoneInput.value.trim(); // Get the entered phone number

    if (validatePhoneNumber(phoneNumber)) {
        alert("Sign up successful!");
    } else {
        alert("Please enter a valid phone number!");
    }
});
