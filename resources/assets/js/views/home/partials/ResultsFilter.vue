<template>
    <section class="hero is-medium is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title" style="text-align:center;">
                    Find Something Awesome Near You
                </h1>
                <form @submit.prevent.stop="getResults">
                    <input type="hidden" name="section" style="display: none;"
                           v-model="filters.section">
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Looking For</label>
                                <div class="control">
                                    <input name="query" class="input is-large" type="text"
                                           placeholder="Pizza" v-model="filters.query">
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <label class="label">In</label>
                            <div class="field">
                                <div class="control">
                                    <input name="location" class="input is-large" type="text" v-model="filters.location"
                                           placeholder="New York" required>

                                </div>
                                <div style="text-align:center;" v-show="showUseCurrentLocation">
                                    <a @click.prevent="useCurrentLocation">
                                        use your current location
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>


                    <!--submit form-->
                    <div class="control" style="text-align: center;margin-top: 10px;">
                        <button type="submit" class="button is-dark is-large">
                            SEARCH
                        </button>
                    </div>
                </form>

                <!--easy selector-->
                <div style="text-align: center;margin-top: 10px;" v-show="filters.location">
                    <button class="button is-large is-dark is-outlined" title="Food"
                            :class="{'is-info':filters.section == 'food'}"
                            @click.prevent="toggleSection('food')">
                        <i class="fas fa-utensils"></i>
                    </button>
                    <button class="button is-large is-dark is-outlined" title="Drinks"
                            :class="{'is-info':filters.section == 'drinks'}"
                            @click.prevent="toggleSection('drinks')">
                        <i class="fas fa-beer"></i>
                    </button>
                    <button class="button is-large is-dark is-outlined" title="Coffee"
                            :class="{'is-info':filters.section == 'coffee'}"
                            @click.prevent="toggleSection('coffee')">
                        <i class="fas fa-coffee"></i>
                    </button>
                    <button class="button is-large is-dark is-outlined" title="Shopping"
                            :class="{'is-info':filters.section == 'shops'}"
                            @click.prevent="toggleSection('shops')">
                        <i class="fas fa-shopping-bag"></i>
                    </button>
                    <button class="button is-large is-dark is-outlined" title="Art"
                            :class="{'is-info':filters.section == 'arts'}"
                            @click.prevent="toggleSection('arts')">
                        <i class="fas fa-image"></i>
                    </button>
                    <button class="button is-large is-dark is-outlined" title="Outdoors"
                            :class="{'is-info':filters.section == 'outdoors'}"
                            @click.prevent="toggleSection('outdoors')">
                        <i class="fas fa-tree"></i>
                    </button>
                    <button class="button is-large is-dark is-outlined" title="Sights"
                            :class="{'is-info':filters.section == 'sights'}"
                            @click.prevent="toggleSection('sights')">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="button is-large is-dark is-outlined" title="Trending"
                            :class="{'is-info':filters.section == 'trending'}"
                            @click.prevent="toggleSection('trending')">
                        <i class="fas fa-chart-line"></i>
                    </button>
                </div>

            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: 'ResultsFilter',
        mounted() {
            // only show the location option if it is available
            if (navigator.geolocation)
                this.showUseCurrentLocation = true;

            this.filters = JSON.parse(JSON.stringify(this.stateFilters))

            window.addEventListener('citySelected', (ev) => {
                this.filters.location = ev.detail.city;
                this.getResults();
            });


        },
        data() {
            return {
                showUseCurrentLocation: false,
                filters: {
                    location: null,
                    section: null,
                    query: null
                }
            };
        },
        computed: {
            stateFilters() {
                return this.$store.state.filters;
            }
        },
        methods: {
            /**
             * Sets the location to the users current location
             */
            useCurrentLocation() {
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
                        default:
                            alert("Something went wrong while trying to retrieve your location.");
                            break;
                    }
                }

                if (navigator.geolocation)
                    navigator.geolocation.getCurrentPosition((position => {
                        let {latitude, longitude} = position.coords;
                        this.filters.location = `${latitude},${longitude}`;
                    }), handleNavError);
            },
            /**
             * Toggles a section
             */
            toggleSection(section) {
                if (this.filters.section === section)
                    this.filters.section = null;
                else
                    this.filters.section = section;

                if (this.filters.location)
                    this.getResults();
            },
            /**
             * Does the api calls to get the data to display to the user
             */
            getResults() {
                // update filters in the state, so the results is aware of it
                this.$store.commit('updateFilters', this.filters);
                this.$store.commit('resetResults');

                // push the results page
                this.$router.push('/results');

                // execute the query for recommendations
                let {location, section, query} = this.filters;
                API.getRecommendations(location, section, query).then(res => {
                    this.$store.commit('updateRecommendations', res.data);
                }).catch(err => {
                    console.log(err);
                    this.$store.commit('updateRecommendations', false);
                });

                // execute the weather query
                API.getWeather(location).then(res => {
                    this.$store.commit('updateWeather', res.data);
                }).catch(err => {
                    console.log(err);
                    this.$store.commit('updateWeather', false);
                });

                API.getPhotos(location).then(res => {
                    this.$store.commit('updatePhotos', res.data);
                }).catch(err => {
                    console.log(err);
                    this.$store.commit('updatePhotos', false);
                });
            }
        }
    }

</script>