/**
 * Import view
 */
import Main from './components/Main';
import Results from './components/Results';
import Venue from './components/Venue';

const routes = [
    {
        path: '/',
        component: Main
    },
    {
        path: '/results',
        component: Results
    },
    {
        path: '/venue/:id',
        component: Venue
    }
];

export default {
    routes: routes
}