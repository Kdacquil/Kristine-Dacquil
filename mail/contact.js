$(document).ready(function () {
    $("#contactForm").on("submit", function (event) {
        event.preventDefault(); // Prevent form from submitting normally

        // Collect form data
        var name = $("#name").val();
        var email = $("#email").val();
        var subject = $("#subject").val();
        var message = $("#message").val();

        // Check if any field is empty
        if (!name || !email || !subject || !message) {
            $('#success').html("<div class='alert alert-danger'>Please fill in all the required fields.</div>");
            return;  // Prevent form submission if fields are missing
        }

        // Google Apps Script URL
        $.ajax({
            url: "https://script.google.com/macros/s/AKfycbxkPNSpJyO8gQTRy5vZIrGVPBfp69pTq7SG085KNk9c3vjtKOPPqzEfALEVF9sK86Js/exec",  // Replace with your actual Google Apps Script URL
            type: "POST",
            data: {
                name: name,
                email: email,
                subject: subject,
                message: message
            },
            success: function(response) {
                // Check the response from Apps Script
                if (response === "Success") {
                    $('#success').html("<div class='alert alert-success'>Your message has been sent successfully.</div>");
                    $('#contactForm').trigger("reset");  // Reset the form
                } else {
                    $('#success').html("<div class='alert alert-danger'>" + response + "</div>");
                }
            },
            error: function(error) {
                $('#success').html("<div class='alert alert-danger'>Sorry, there was an issue sending your message. Please try again later.</div>");
            }
        });
    });
});
