/**
 * Data store
 * @type {Store|*}
 */
export default new Vuex.Store({
    state: {
        user: null,
        filters: {
            location: null,
            section: null,
            query: null
        },
        recommendations: null,
        weather: null,
        venue: null,
        photos: null

    },
    mutations: {
        updateRecommendations(state, data) {
            state.recommendations = data;
        },
        updateFilters(state, data) {
            state.filters = data;
        },
        resetResults(state) {
            state.recommendations = null;
            state.weather = null;
            state.photos = null;
        },
        updateWeather(state, data) {
            state.weather = data;
        },
        updatePhotos(state, data) {
            state.photos = data;
        },
        updateVenue(state, newVenue) {
            state.venue = newVenue;
        },
        updateUser(state, user) {
            state.user = user;
        }
    }
});