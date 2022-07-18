"use strict";

(() => {
    document.addEventListener("DOMContentLoaded", () => {
        const loginForm = document.getElementById("login-form");

        if (loginForm) {
            loginForm.setAttribute("novalidate", "");

            loginForm.addEventListener("submit", (ev) => {
                // Username
                const username = loginForm.elements["username"];
                // Password
                const password = loginForm.elements["password"];

                /* Validation */
                hideAllErrors(loginForm);

                if (username.value.trim() === "") {
                    showError(username, ev, "Username is required");
                }

                if (password.value.trim() === "") {
                    showError(password, ev, "Password is required");
                }
            });
        }
    });

    /**
     * Show an error message for an invalid form field.
     * 
     * @param {HTMLFormElement} field The form field that is invalid.
     * @param {Event} event The event object of the form submission.
     * @param {string} errorMessage The custom error message to show.
     */
    function showError(field, event, errorMessage = null) {
        // Stop the form from submitting
        event.preventDefault();

        field.classList.add("is-invalid");
        field.parentElement.classList.add("error-row");

        if (errorMessage !== null) {
            let errorSpan;         
            errorSpan = field.parentElement.querySelector(`.error-message`);   
            if (errorSpan === null) {
                errorSpan = document.createElement("span");
                errorSpan.classList.add("error-message");
                field.parentElement.appendChild(errorSpan);
            }
            // Update error message in the span
            errorSpan.innerText = errorMessage;
        }
    }
 
 
    /**
     * Hide all errors for the given form.
     * 
     * @param {Element} form The form to hide all errors within.
     */
    function hideAllErrors(form) {
        const errors = form.querySelectorAll(`.error-row`);
        for (const error of errors) {
            error.classList.remove("error-row");
            const invalidInputs = error.getElementsByClassName("is-invalid");
            for (const input of invalidInputs) {
                input.classList.remove("is-invalid");
            }
        }
    }
})();