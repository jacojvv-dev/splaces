export default class SplacesEvents {
    /**
     * Dispatched a city selected event on the window object
     * @param city
     */
    static dispatchCitySelectedEvent(city) {
        let ev = new CustomEvent("citySelected",
            {
                detail: {
                    city: city,
                    time: new Date(),
                },
                bubbles: true,
                cancelable: true
            }
        );
        window.dispatchEvent(ev);
    }
}