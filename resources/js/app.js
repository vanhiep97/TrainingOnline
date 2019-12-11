require('./bootstrap');

import Vue from 'vue';
import router from './router'
Vue.router = router;
import ElementUI from 'element-ui';
import './theme/index.css';
Vue.use(ElementUI);
import Suntech from './Views/App';


const app = new Vue({
    el: '#app',
    router,
    components: {Suntech},
});
