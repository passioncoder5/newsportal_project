// admincheck_session.js

window.onload = function() {
    checkSession(); // Check session status when the page loads
};

function checkSession() {
    // Perform an AJAX request to check the session status
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Response from the server
            var response = xhr.responseText;
            if (response === "valid") {
                // Session is valid, do nothing
            } else {
                // Session is not valid, redirect to the login page
                alert("Session expired. Please log in again.");
                window.location.href = "index.php";
            }
        }
    };

    // Get the admin's session variable from the hidden input field
    var aemail = document.getElementById("aemail").value;

    // Make the request to a server-side script that checks the session
    xhr.open("GET", "admin_check_session.php?aemail=" + aemail, true);
    xhr.send();
}
