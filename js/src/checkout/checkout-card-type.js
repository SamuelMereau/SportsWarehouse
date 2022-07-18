"use strict";

(() => {
    document.addEventListener("DOMContentLoaded", (ev) => {
        const cardNumberInput = document.getElementById("checkout__card-number-input");
        
        cardNumberInput.addEventListener("keyup", (ev) => {
            const cardNumber = cardNumberInput.value;

            if (cardNumber.length >= 1) {
                identifyCardProvider(cardNumber.substring(0, 1));
            } else {
                identifyCardProvider("");
            }
        })
    });

    /**
     * Identifies card provider from given number
     * @param {string} num First number of card number to identify
     */
    function identifyCardProvider(num) {
        const visaImg = "./img/card-providers/visa.png";
        const mastercardImg = "./img/card-providers/mastercard.png";
        const amexImg = "./img/card-providers/amex.png";
        const defaultImg = "./img/card-providers/default.png";
        switch (num) {
            case "4":
                setProvider(visaImg);
                break;
            case "5":
                setProvider(mastercardImg);
                break;
            case "3":
                setProvider(amexImg);
                break;
            default:
                setProvider(defaultImg);
                break;
        }
    }

    /**
     * Sets the image source of the card provider icon
     * @param {string} imgPath Path to image
     */
    function setProvider(imgPath) {
        const cardNumberImg = document.getElementById("checkout__card-icon");
        cardNumberImg.src = imgPath;
    }
})();