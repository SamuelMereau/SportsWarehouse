"use strict";

(() => {
    document.addEventListener("DOMContentLoaded", () => {
        const themeForm = document.getElementById("theme-form");

        if (themeForm) {
            themeForm.setAttribute("novalidate", "");

            const submit = themeForm.elements["submit"];
            submit.removeAttribute("disabled");
            submit.removeAttribute("title");
            submit.removeAttribute("style");

            themeForm.addEventListener("submit", (ev) => {
                // Programmed themes
                const lightTheme = themeForm.elements["light-theme"];
                const darkTheme = themeForm.elements["dark-theme"];

                if (username) {
                    if (darkTheme.checked) {
                        createCookie(`${username}-dark-theme`, "true", "128");
                    } else if (lightTheme.checked) {
                        createCookie(`${username}-dark-theme`, "false", "128");
                    }
                }
            });
        }
    });

    /**
     * Creates a cookie
     * @param {string} name Name of cookie
     * @param {string} value Value of cookie
     * @param {string} days Number of days to store cookie
     */
    function createCookie(name, value, days) {
        var expires;
          
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else {
            expires = "";
        }
          
        document.cookie = encodeURIComponent(name) + "=" + 
            encodeURIComponent(value) + expires + "; path=/";
    }
})();