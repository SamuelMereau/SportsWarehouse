"use strict";

(() => {
    document.addEventListener("DOMContentLoaded", () => {
        const checkoutForm = document.getElementById("checkout-form");

        if (checkoutForm) {
            checkoutForm.setAttribute("novalidate", "");

            checkoutForm.addEventListener("submit", (ev) => {
                // Name
                const firstName = checkoutForm.elements["first-name"];
                const lastName = checkoutForm.elements["last-name"];

                // Address
                const streetAddress = checkoutForm.elements["street-address"];
                const streetAddress2 = checkoutForm.elements["street-address-2"];
                const city = checkoutForm.elements["city"];
                const state = checkoutForm.elements["state"];
                const postcode = checkoutForm.elements["postcode"];
                
                // Contact Number
                const contactNumber = checkoutForm.elements["contact-number"];

                // Email Address
                const emailAddress = checkoutForm.elements["email-address"];

                // Name on card
                const nameOnCard = checkoutForm.elements["name-on-card"];

                // Card Number
                const cardNumber = checkoutForm.elements["card-number"];

                // Card expiration
                const cardExpirationMonth = checkoutForm.elements["card-expiration-month"];
                const cardExpirationYear = checkoutForm.elements["card-expiration-year"];

                // Card CVC / CVV
                const cardCVC = checkoutForm.elements["card-cvc"];

                /* Validation */

                hideAllErrors(checkoutForm);

                const regexPostcode = /^\d{3,4}$/;
                const regexEmail = /(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/;
                const regexPhone = /^((000|112|106)|((13|18)([- ]?\d){4})|((1300|1800|190\d)([- ]?\d){6})|(((\+61[- ]?\(?)|(\(?0[- ]?))[23478]\)?([- ]?\d){8}))$/;
                const regexCard = /\s|\-|[a-zA-Z]/;
                const regexCardExpirationMonth = /^(0[1-9])|(1[0-2])$/;
                const regexCVC = /^\d{3}$/;
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

                // Validate street address

                if (streetAddress.value === "") {
                    showError(streetAddress, ev, "Street Address is required");
                } else if (streetAddress.value.trim().length < 2) {
                    showError(streetAddress, ev, "Must be 2+ characters");
                }
                if (city.value === "") {
                    showError(city, ev, "City is required");
                } else if (city.value.trim().length < 2) {
                    showError(city, ev, "Must be 2+ characters");
                }
                const allowedStates = ["NSW", "ACT", "VIC", "QLD", "NT", "SA", "WA", "TAS"];
                if (!allowedStates.some(v => state.value.trim().includes(v))) {
                    showError(state, ev, "Please select a state from the list");
                }
                if (postcode.value === "") {
                    showError(postcode, ev, "Postcode is required");
                } else if(!regexPostcode.test(postcode.value)) {
                    showError(postcode, ev, "Invalid postcode");
                }

                // Validate contact number

                if (contactNumber.value === "") {
                    showError(contactNumber, ev, "Contact Number is required");
                } else if (!regexPhone.test(contactNumber.value)) {
                    showError(contactNumber, ev, "Only valid Australian phone numbers are accepted");
                }

                // Validate Email

                if (emailAddress.value === "") {
                    showError(emailAddress, ev, "Email is required");
                } else if (!regexEmail.test(emailAddress.value)) {
                    showError(emailAddress, ev, "Email must have valid format");
                }

                // Validate Payment Details

                if (nameOnCard.value === "") {
                    showError(nameOnCard, ev, "Name on Card is required");
                } else if (nameOnCard.value.trim().length < 2) {
                    showError(nameOnCard, ev, "Must be 2+ characters");
                }

                if (cardNumber.value === "") {
                    showError(cardNumber, ev, "Card Number is required");
                } else if (cardNumber.value.trim().length < 13) {
                    showError(cardNumber, ev, "Minimum of 13 digits required");
                } else if (regexCard.test(cardNumber.value)) {
                    showError(cardNumber, ev, "Invalid card number (do not include spaces, dashes or letters)");
                }

                if (cardExpirationMonth.value === "") {
                    showError(cardExpirationMonth, ev, "Card Expiration Month is required");
                } else if (!regexCardExpirationMonth.test(cardExpirationMonth.value)) {
                    showError(cardExpirationMonth, ev, "Invalid month number (numbers below 10 must have a leading 0, e.g 01)");
                }

                if (cardExpirationYear.value === "") {
                    showError(cardExpirationYear, ev, "Card Expiration Year is required");
                } else if (cardExpirationYear.value.trim().length > 2) {
                    showError(cardExpirationYear, ev, "Maxiumum of 2 digits required");
                }

                if (cardCVC.value === "") {
                    showError(cardCVC, ev, "Card CVC / CVV is required");
                } else if (!regexCVC.test(cardCVC.value)) {
                    showError(cardCVC, ev, "Invalid CVC / CVV");
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

        if (field.id === "checkout__card-number-input") {
            // Traverse the DOM one node higher
            field.parentElement.parentElement.classList.add("error-row");
        } else {
            field.parentElement.classList.add("error-row");
        }

        field.classList.add("is-invalid");

        if (errorMessage !== null) {
            let errorSpan;

            if (field.id === "checkout__card-number-input") {
                // Traverse the DOM one node higher
                errorSpan = field.parentElement.parentElement.querySelector(`.error-message`);
            } else {
                errorSpan = field.parentElement.querySelector(`.error-message`);
            }

            
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