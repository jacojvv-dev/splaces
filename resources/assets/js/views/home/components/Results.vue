<template>
    <div>
        <results-filter></results-filter>

        <!--weather section-->
        <div class="section" v-if="!weather && weather !== false">
            <h3 class="title is-3" style="text-align: center;">
                <i class="fas fa-spin fa-circle-notch"></i> <br>
                Fun in the sun, or a coffee in a warm cafe? <br>Checking the weather!
            </h3>
        </div>
        <div v-else-if="weather != null && weather !== false" style="text-align: center;">
            <img class="image"
                 style="margin: 0 auto;"
                 :src="'http://openweathermap.org/img/w/'+ weather.weather[0].icon +'.png'"
                 :alt="weather.weather[0].description">
            <h2 class="title is-2 ">
                {{weather.main.temp}} °C
                <span v-if="weather.weather[0].main" class="has-text-grey">
                    | {{weather.weather[0].main}}
                </span>
                <span class="has-text-grey-light">
                    <span v-if="weather.weather[0].main">|</span>
                    Min : {{weather.main.temp_min}} |
                    Max : {{weather.main.temp_max}}
                </span>
            </h2>
        </div>

        <!--photos section-->
        <div class="section" v-if="!photos && photos !== false">
            <h3 class="title is-3" style="text-align: center;">
                <i class="fas fa-spin fa-circle-notch"></i> <br>
                Getting photos of the area
            </h3>
        </div>
        <div class="section" v-else-if="photos != null && photos !== false">
            <h3 class="title is-3">Photos</h3>
            <div class="columns is-multiline">
                <div v-if="photos.photos.photo.length > 0"
                     class="column is-one-fifth"
                     v-for="photo in photos.photos.photo">
                    <img style="margin: 0 auto;cursor: pointer;" class="image" @click="viewPhoto(photo)"
                         :src="photo.url_q" alt="">
                </div>
                <div v-if="photos.photos.photo.length === 0">
                    <p>No photos found.</p>
                </div>
            </div>
        </div>

        <!--recommendations section-->
        <div class="section" v-if="!recommendations && recommendations !== false" style="text-align: center;">
            <h3 class="title is-3">
                <i class="fas fa-spin fa-circle-notch"></i> <br>
                Finding places for you to be awesome at!
            </h3>
        </div>
        <div class="section" v-else-if="recommendations != null && recommendations !== false">
            <div v-for="group in recommendations.groups">
                <h3 class="title is-3">{{group.type}}</h3>
                <div class="columns is-multiline ">
                    <div v-for="item in group.items" class="column is-one-third">
                        <router-link tag="div" class="card" :to="'venue/' + item.venue.id">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img :src="item.fullImageUrl"/>
                                </figure>
                            </div>
                            <div class=" card-content">
                                <p class="title is-4">{{item.venue.name}}</p>
                                <div class="content">
                                    {{item.topTip}} <br>
                                    <!--@foreach($item->venue->location->formattedAddress as $part)-->
                                    <!--{{$part}} <br>-->
                                    <!--@endforeach-->
                                </div>
                            </div>
                        </router-link>
                        <!--<div class="card" >-->

                        <!--</div>-->
                    </div>
                </div>
            </div>
        </div>

        <b-modal :active.sync="imageModalActive">
            <div v-if="imageModalPhoto" style="text-align: center;">
                <img v-if="imageModalPhoto.url_o" :src="imageModalPhoto.url_o"/>
                <img v-else-if="imageModalPhoto.url_c" :src="imageModalPhoto.url_c"/>
                <img v-else-if="imageModalPhoto.url_z" :src="imageModalPhoto.url_z"/>
                <img v-else-if="imageModalPhoto.url_n" :src="imageModalPhoto.url_n"/>
                <img v-else-if="imageModalPhoto.url_m" :src="imageModalPhoto.url_m"/>
                <img v-else-if="imageModalPhoto.url_t" :src="imageModalPhoto.url_t"/>
            </div>
            <div v-if="imageModalPhoto">

                <h3 class="title is-3 has-text-white">
                    {{imageModalPhoto.title}}
                </h3>
                <div class="has-text-white" v-html="imageModalPhoto.description._content"></div>
                <p class="has-text-grey">
                    <span v-if="imageModalPhoto.ownername"><b>Owner:</b> {{imageModalPhoto.ownername}} <br></span>
                    <span v-if="imageModalPhoto.views"><b>Views:</b> {{imageModalPhoto.views}} <br></span>
                    <span v-if="imageModalPhoto.tags"><b>Tags:</b> {{imageModalPhoto.tags}} <br></span>
                    <span v-if="imageModalPhoto.datetaken"><b>Date Taken:</b> {{imageModalPhoto.datetaken}} </span>
                </p>
            </div>
        </b-modal>
    </div>
</template>

<script>
    import ResultsFilter from '../partials/ResultsFilter';

    export default {
        name: 'Results',
        components: {
            'results-filter': ResultsFilter
        },
        mounted() {
            // make sure the user is not entering on the results page
            let {location, section, query} = this.filters;
            if (location == null && section == null && query == null)
                this.$router.push('/');
        },
        data() {
            return {
                imageModalActive: false,
                imageModalPhoto: null
            }
        },
        computed: {
            recommendations() {
                return this.$store.state.recommendations;
            },
            weather() {
                return this.$store.state.weather;
            },
            photos() {
                return this.$store.state.photos;
            },
            filters() {
                return this.$store.state.filters;
            }
        },
        methods: {
            viewPhoto(photo) {
                console.log(photo);

                this.imageModalPhoto = photo;
                this.imageModalActive = true;


            }
        }
    }
</script>