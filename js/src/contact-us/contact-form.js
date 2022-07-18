"use strict";

(() => {
    document.addEventListener("DOMContentLoaded", () => {
        const contactForm = document.getElementById("contact-form");

        if (contactForm) {
            contactForm.setAttribute("novalidate", "");

            contactForm.addEventListener("submit", (ev) => {
                // Name
                const firstName = contactForm.elements["first-name"];
                const lastName = contactForm.elements["last-name"];

                // Contact Number
                const contactNumber = contactForm.elements["contact-number"];

                // Email Address
                const emailAddress = contactForm.elements["email-addr"];

                // Question
                const question = contactForm.elements["question"];

                /* Validation */

                hideAllErrors(contactForm);

                const regexEmail = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
                const regexPhone = /^((000|112|106)|((13|18)([- ]?\d){4})|((1300|1800|190\d)([- ]?\d){6})|(((\+61[- ]?\(?)|(\(?0[- ]?))[23478]\)?([- ]?\d){8}))$/;

                // Validate Name

                if (firstName.value === "") {
                    showError(firstName, ev, "First Name is required");
                } else if (firstName.value.trim().length < 2) {
                    showError(firstName, ev, "Must be 2+ characters");
                } 
                if (lastName.value === "") {
                    showError(lastName, ev, "Last Name is required");
                } else if (lastName.value.trim().length < 2) {
                    showError(lastName, ev, "Must be 2+ characters");
                }

                // Validate contact number

                if (contactNumber.value !== "") {
                    if (!regexPhone.test(contactNumber.value)) {
                        showError(contactNumber, ev, "Only valid Australian phone numbers are accepted");
                    }
                }

                // Validate Email

                if (emailAddress.value === "") {
                    showError(emailAddress, ev, "Email is required");
                } else if (!regexEmail.test(emailAddress.value)) {
                    showError(emailAddress, ev, "Email must have valid format, e.g user@domain.com");
                }

                // Validate question

                if (question.value === "") {
                    showError(question, ev, "Question is required");
                } else if (question.value.trim().length < 30) {
                    showError(question, ev, "Must be 30+ characters");
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
    function showError(field, event, errorMessage = null)
    {
        // Stop the form from submitting
        event.preventDefault();

        field.classList.add("is-invalid");
        field.parentElement.classList.add("error-row");

        if (errorMessage !== null) {
            let errorSpan = field.parentElement.querySelector(`.error-message`);

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
    function hideAllErrors(form)
    {
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