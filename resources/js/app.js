/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");
import Vue from 'vue';
import apolloProvider from './apollo'
import App from "./App.vue";
// import VueAxios from "vue-axios";
import VueRouter from "vue-router";
// import axios from "axios";
import router from "./routes";
import store from "./store";
import VueSimpleAlert from "vue-simple-alert";

import VueQuillEditor from 'vue-quill-editor';  // Text editor

import 'quill/dist/quill.core.css'; // require styles of Text editor
import 'quill/dist/quill.snow.css'; // require styles of Text editor
import 'quill/dist/quill.bubble.css'; // require styles of Text editor


Vue.config.productionTip = false

Vue.use(VueRouter);
// Vue.use(VueAxios, axios);
Vue.use(VueSimpleAlert);
Vue.use(VueQuillEditor, /* { default global options } */)

const app = new Vue({
    el: "#app",
    apolloProvider,
    store,
    router,
    template: '<App/>',
    components: { App }
});
