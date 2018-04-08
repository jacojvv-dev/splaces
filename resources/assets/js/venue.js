// make sure the document is ready before we load things
document.addEventListener('DOMContentLoaded', () => {
    // images of the venue
    const venueImages = document.getElementsByName('venueImage');
    // modal to view image fullscreen
    const mdl_view_image = document.getElementById('mdl_view_image');
    // modal to view image image element
    const mdl_view_image_imageElement = document.getElementById('mdl_view_image_imageElement');
    // modal close buttons
    const mdl_view_image_close_buttons = document.getElementsByName('mdl_view_image_close');

    /**
     * Opens the image modal
     * @param e
     */
    function openImageModal(e) {
        mdl_view_image_imageElement.src = e.target.src;
        mdl_view_image.classList.add('is-active');
    }

    /**
     * Closes the image modal
     */
    function closeImageModal() {
        mdl_view_image.classList.remove('is-active');
    }

    // add listener to images
    for (let i = 0; i < venueImages.length; i++)
        venueImages[i].addEventListener('click', openImageModal);

    // add listener to close buttons
    for (let i = 0; i < mdl_view_image_close_buttons.length; i++)
        mdl_view_image_close_buttons[i].addEventListener('click', closeImageModal);
});
