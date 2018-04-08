<template>
    <div>
        <results-filter></results-filter>
        <div class="container">
            <div class="section">
                <h2 class="title is-2">Awesome Cities</h2>
                <div class="columns">
                    <div class="column">
                        <div class="card" style="cursor: pointer;" @click="setCity('Cape Town')">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img src="https://farm6.staticflickr.com/5513/11936162635_49f84f80a2_c.jpg"
                                         alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4">Cape Town</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card" style="cursor: pointer;" @click="setCity('New York')">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img src="https://farm8.staticflickr.com/7682/17115508646_49aecae924_c.jpg"
                                         alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4">New York</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card" style="cursor: pointer;" @click="setCity('Tokyo')">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img src="https://farm6.staticflickr.com/5029/13965519478_ab79f523df_c.jpg"
                                         alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4">Tokyo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card" style="cursor: pointer;" @click="setCity('Vienna')">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img src="https://farm8.staticflickr.com/7375/9416917210_da5c3a0b93_c.jpg"
                                         alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4">Vienna</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card" style="cursor: pointer;" @click="setCity('Paris')">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img src="https://farm7.staticflickr.com/6020/5929463035_5a9fe99bbc_z.jpg"
                                         alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4">Paris</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="card" style="cursor: pointer;" @click="setCity('Sydney')">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img src="https://farm6.staticflickr.com/5448/17316210479_5d039789a4_c.jpg"
                                         alt="Placeholder image">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-content">
                                        <p class="title is-4">Sydney</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="container" v-if="latestSearches && latestSearches.length > 0">
            <div class="section">
                <h2 class="title is-2">Recent Community Searches</h2>
                <div class="tags">
                    <span v-for="search in latestSearches"
                          class="tag is-light is-medium is-rounded"
                          style="cursor: pointer;"
                          @click="setCity(search.location)">
                        {{search.location}}
                    </span>
                </div>
            </div>
        </div>

        <div class="container" v-if="latestVenueViews && latestVenueViews.length > 0">
            <div class="section">
                <h2 class="title is-2">Recently Viewed Venues</h2>
                <div class="tags">
                    <router-link
                            v-for="venueView in latestVenueViews"
                            style="cursor: pointer;"
                            :key="venueView.venue_id"
                            tag="span" class="tag is-light is-medium is-rounded"
                            :to="'venue/' + venueView.venue_id">
                        {{venueView.venue_name}}
                    </router-link>
                </div>
            </div>
        </div>


    </div>
</template>

<script>
    import ResultsFilter from '../partials/ResultsFilter';
    import SplacesEvents from "../../../classes/SplacesEvents";

    export default {
        components: {
            'results-filter': ResultsFilter
        },
        mounted() {
            // get latest searches when component mounts
            this.getLatestSearches();
            this.getLatestVenueViews();
        },
        data() {
            return {
                latestSearches: null,
                latestVenueViews: null
            }
        },
        methods: {
            /**
             * Sets the city to a selected city
             * @param city
             */
            setCity(city) {
                SplacesEvents.dispatchCitySelectedEvent(city);
            },
            getLatestSearches() {
                API.getLatestSearches().then(res => {
                    console.log(res);
                    this.latestSearches = res.data;
                }).catch(err => {
                    console.log(err);
                })
            },
            getLatestVenueViews() {
                API.getLatestVenueViews().then(res => {
                    console.log(res);
                    this.latestVenueViews = res.data;
                }).catch(err => {
                    console.log(err);
                })
            }
        }
    }
</script>