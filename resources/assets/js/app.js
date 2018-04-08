require('./bootstrap');

// make sure the document is ready before we load things
document.addEventListener('DOMContentLoaded', () => {
    // search form
    const frm_search_locations = document.getElementById('frm_search_locations');
    // location text box
    const txt_location = document.getElementById('txt_location');
    // section text box
    const txt_section = document.getElementById('txt_section');
    // button/link to use the current user location
    const btn_use_current_location = document.getElementById('btn_use_current_location');
    // section option buttons
    const section_option_buttons = document.getElementsByName('section_option');


    /**
     * Use current location button
     */
    if (btn_use_current_location) {
        // lets make sure the browser supports geolocation, otherwise hide the option
        if (!navigator.geolocation)
            btn_use_current_location.style.display = 'none';

        /**
         * Update the position based on the navigator
         * @param position
         */
        function updateNavPosition(position) {
            console.log(position);
            let {latitude, longitude} = position.coords;
            txt_location.value = `${latitude},${longitude}`;
        }

        /**
         * Handle a navigation error
         * @param error
         */
        function handleNavError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    console.log('Navigation permission denied');
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The location request timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("Something went wrong while trying to retrieve your location.");
                    break;
            }
        }

        /**
         * Add a click listener to the current location button
         */
        btn_use_current_location.addEventListener('click', () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(updateNavPosition, handleNavError);
            }
        });
    }

    /**
     * If the section option buttons are available
     */
    if (section_option_buttons && section_option_buttons.length > 0)
        for (let i = 0; i < section_option_buttons.length; i++)
            section_option_buttons[i].addEventListener('click', (e) => {
                txt_section.value = e.target.getAttribute('data-value');
                frm_search_locations.submit();
            });


});




