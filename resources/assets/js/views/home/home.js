/**
 * Import the api
 */
import API from './home.api';

window.API = API;

/**
 * Import Routes
 */
import routes from './home.routes';

const router = new VueRouter({
    mode: 'hash',
    base: '/',
    routes: routes.routes,
    linkActiveClass: 'is-active'
});

/**
 * Import datastore
 */
import store from './home.store';

const app = new Vue({
    el: '#app',
    router: router,
    store: store,
    computed: {
        user() {
            return this.$store.state.user;
        }
    },
    mounted() {
        API.getUser().then(res => {
            console.log('user');
            console.log(res);

            if (res.data !== "")
                this.$store.commit('updateUser', res.data);
        }).catch(err => {
            console.log(err);
        });
    }

});