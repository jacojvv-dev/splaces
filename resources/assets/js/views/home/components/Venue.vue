<template>
    <div>
        <!--show loading while we are getting the details-->
        <div style="text-align: center;" v-if="venue == null">
            <h3 class="title is-3">
                <i class="fas fa-spin fa-circle-notch"></i> <br>
                Getting more info about this location, hang tight!
            </h3>
        </div>
        <div v-else>
            <section class="hero is-small is-primary is-bold">
                <div class="hero-body">
                    <div class="container">
                        <h1 class="title" style="text-align:center;">
                            <a v-show="hasFilters" @click.prevent="returnToResults" href=""><i
                                    class="fas fa-arrow-left"></i></a>
                            {{venue.name}}
                            <a v-show="user !== null && !userHasFavouritedVenue" @click.prevent.stop="addVenueForUser"
                               href="">
                                <i class="far fa-star"></i>
                            </a>
                            <a v-show="user !== null && userHasFavouritedVenue === true"
                               @click.prevent.stop="removeVenueForUser" href="" class="has-text-warning">
                                <i class="fas fa-star"></i>
                            </a>
                        </h1>
                    </div>
                </div>
            </section>
            <div class="container">
                <div class="section">
                    <!--details boxes-->
                    <div class="columns">
                        <!--contact details-->
                        <div class="column">
                            <div class="box">
                                <h5 class="title is-5">Contact Details</h5>
                                <table class="table">
                                    <tr v-if="venue.contact && venue.contact.phone">
                                        <td><b>Phone</b></td>
                                        <td>{{venue.contact.phone}}</td>
                                    </tr>
                                    <tr v-if="venue.location && venue.location.address">
                                        <td><b>Address</b></td>
                                        <td>{{venue.location.address}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!--facts-->
                        <div class="column">
                            <div class="box">
                                <h5 class="title is-5">Interesting Facts</h5>
                                <table class="table">
                                    <tr v-if="venue.price && venue.price.message">
                                        <td><b>Pricing</b></td>
                                        <td>{{venue.price.message}}</td>
                                    </tr>
                                    <tr v-if="venue.rating">
                                        <td><b>Rating</b></td>
                                        <td>{{venue.rating}} / 10</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--photos-->
                    <div v-if="venue.photos && venue.photos.groups">
                        <h5 class="title is-5">Photos</h5>
                        <div class="columns is-multiline">
                            <template v-for="group in venue.photos.groups">
                                <div v-for="item in group.items" class="column is-one-third">
                                    <figure class="image is-square">
                                        <img :src="item.prefix + item.width + 'x' + item.height + item.suffix"
                                             :alt="item.id"
                                             @click="viewImage"
                                             name="venueImage">
                                    </figure>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!--tips and comments-->
                    <div v-if="venue.tips && venue.tips.groups" style="margin-top: 20px;">
                        <h5 class="title is-5">Comments</h5>
                        <div class="columns is-multiline">
                            <template v-for="group in venue.tips.groups">
                                <div class="column is-half" v-for="item in group.items">
                                    <div class="box">
                                        <article class="media">
                                            <div class="media-left">
                                                <figure class="image is-64x64">
                                                    <img :src="item.user.photo.prefix + '64x64' + item.user.photo.suffix">
                                                </figure>
                                            </div>
                                            <div class="media-content">
                                                <div class="content">
                                                    <p>
                                                        <strong>
                                                            {{item.user.firstName}}
                                                            {{item.user.lastName}}
                                                        </strong>
                                                        <br>
                                                        {{item.text}}
                                                    </p>
                                                </div>
                                            </div>
                                        </article>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>

            <b-modal :active.sync="showImageModal">
                <p class="image">
                    <img :src="imageModalSource">
                </p>
            </b-modal>

        </div>
    </div>
</template>

<script>
    export default {
        name: 'Venue',
        mounted() {
            let id = this.$route.params.id;
            if (!this.venue || this.venue.id !== id)
                this.getVenue();
        },
        data() {
            return {
                showImageModal: false,
                imageModalSource: null
            }
        },
        computed: {
            venue() {
                return this.$store.state.venue;
            },
            hasFilters() {
                let filterState = this.$store.state.filters;
                let {location, section, query} = filterState;
                return location || section || query;
            },
            user() {
                return this.$store.state.user;
            },
            userHasFavouritedVenue() {
                if (!this.user)
                    return false;

                for (let i = 0; i < this.user.venues.length; i++) {
                    if (this.user.venues[i].venue_id === this.venue.id)
                        return true;
                }


                return false;
            }
        },
        methods: {
            /**
             * Retrieves the venue the user wants to view
             */
            getVenue() {
                this.$store.commit('updateVenue', null);
                let id = this.$route.params.id;
                API.getVenue(id).then(res => {
                    this.$store.commit('updateVenue', res.data);
                }).catch(err => {
                    console.log(err);
                });
            },
            /**
             * Displays an image fullscreen
             * @param image
             */
            viewImage(image) {
                this.imageModalSource = image.target.src;
                this.showImageModal = true;
            },
            /**
             * Returns the user to the results page
             */
            returnToResults() {
                this.$router.push('/results');
            },
            addVenueForUser() {
                let {id, name} = this.venue;
                API.addUserVenue(id, name).then(res => {
                    if (res && res.data && res.data.id)
                        this.$store.commit('updateUser', res.data);
                }).catch(err => {
                    console.log(err);
                });
            },
            removeVenueForUser() {
                let {id} = this.venue;
                API.removeUserVenue(id).then(res => {
                    if (res && res.data && res.data.id)
                        this.$store.commit('updateUser', res.data);
                }).catch(err => {
                    console.log(err);
                });
            }
        }
    }
</script>