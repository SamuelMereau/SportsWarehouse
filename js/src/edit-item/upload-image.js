"use strict";

(() => {
    document.addEventListener("DOMContentLoaded", (ev) => {
        const uploadImage = document.getElementById("upload-item-photo");
        const removeImage = document.getElementById("remove-photo");

        // Enable controls
        document.getElementById("upload-item-photo-label").classList.remove("disabled");
        uploadImage.removeAttribute("disabled");
        uploadImage.removeAttribute("title");

        if (removeImage) {
            removeImage.removeAttribute("disabled");
            removeImage.removeAttribute("title");
        }

        uploadImage.addEventListener('change', (ev) => {
            if ('files' in uploadImage) {
                if (hasAllowedMimeType(ev.target.files[0].type)) {
                    if (hasCorrectFileSize(ev.target.files[0].size)) {
                        fileSelectBase64(ev);
                    } else {
                        ev.preventDefault();
                        return alert("Maximum file size limit exceeded. Images must be less than 2MB in size."); 
                    }
                } else {
                    ev.preventDefault();
                    return alert("Incorrect file type provided. Please only upload a JPG (.jpg or .jpeg), PNG (.png) or a GIF (.gif).");
                }
            }
        });

        if (removeImage) {
            removeImage.addEventListener('click', (ev) => {
                document.getElementById("image-preview").src = "./img/product-images/placeholder.svg";
                document.getElementById("server-should-remove-photo").setAttribute("value", "1");
            });
        }
    });

    function fileSelectImg(evt) {
        const image = evt.target.files[0];

        const reader = new FileReader();
        reader.onload = ((file) => {
            return (e) => {
                document.getElementById("image-preview").src = e.target.result;
            }
        })(image);

        reader.readAsText(image);
    }

    function fileSelectBase64(evt) {
        const image = evt.target.files[0];

        const reader = new FileReader();
        reader.onload = ((file) => {
            return (e) => {
                document.getElementById("image-preview").src = e.target.result;
            }
        })(image);

        reader.readAsDataURL(image);
    }

    function hasAllowedMimeType(contentType) {
        const pattern = /(image\/)\b(?:gif|jpeg|png)/g;
        const isAllowed = pattern.test(contentType); 
        return isAllowed;
    }

    function hasCorrectFileSize(size) {
        const mbSize = size / 1024 / 1024
        if (mbSize > 2) {
            return false;
        }
        return true;
    }
})();