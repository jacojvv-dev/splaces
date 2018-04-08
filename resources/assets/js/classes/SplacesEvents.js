export default class SplacesEvents {
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