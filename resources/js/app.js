require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueQuillEditor from 'vue-quill-editor';

import 'quill/dist/quill.core.css' // import styles
import 'quill/dist/quill.snow.css' // for snow theme
import 'quill/dist/quill.bubble.css' // for bubble theme

import router from './routes';
import App from './App.vue';
import store from './store';

Vue.use(VueRouter);
Vue.use(VueQuillEditor, /* { default global options } */)

const app = new Vue({
    store,
    router,
    el: '#app',
    render: h => h(App)
});
