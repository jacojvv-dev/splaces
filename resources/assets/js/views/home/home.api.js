export default {
    url: '/data/',
    getUser() {
        return axios.get(this.url + `user`);
    },
    /**
     * Retrieves recommendations
     * @param location
     * @param section
     * @param query
     * @returns {*}
     */
    getRecommendations(location, section = null, query = null) {
        if (typeof section === typeof '' && section.trim().length <= 0)
            section = null;
        if (typeof query === typeof '' && query.trim().length <= 0)
            query = null;

        let url = `recommendations/${location}/${section}/${query}`;
        return axios.get(this.url + url);
    },
    /**
     * Retrieves the weather for a location
     * @param location
     * @returns {*}
     */
    getWeather(location) {
        return axios.get(this.url + `weather/${location}`);
    },
    /**
     * Retrieves a venue by id
     * @param id
     * @returns {*}
     */
    getVenue(id) {
        return axios.get(this.url + `venue/${id}`);
    },
    /**
     * Retrieves photos for a location
     * @param location
     * @returns {*}
     */
    getPhotos(location) {
        return axios.get(this.url + `photos/${location}`);
    },
    /**
     * Retrieves latest searches
     * @returns {*}
     */
    getLatestSearches() {
        return axios.get(this.url + `latestsearches`);
    },
    /**
     * Retrieves the latest venue views
     * @returns {*}
     */
    getLatestVenueViews() {
        return axios.get(this.url + `latestvenueviews`);
    },
    /**
     * Adds a venue to a user
     * @param venueId
     * @param venueName
     * @returns {*|AxiosPromise<any>}
     */
    addUserVenue(venueId, venueName) {
        let data = {
            'id': venueId,
            'name': venueName
        };
        return axios.post(this.url + `user/venues/add`, data);
    },
    /**
     * Removes a venue from a user
     * @param venueId
     * @returns {*|AxiosPromise<any>}
     */
    removeUserVenue(venueId) {
        let data = {
            'id': venueId
        };
        return axios.post(this.url + `user/venues/remove`, data);
    }
}