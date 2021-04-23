import Vue from 'vue';
import VueRouter from 'vue-router';

import Post from '../views/posts/Post.vue';
import Create from '../views/posts/Create.vue';
import Edit from '../views/posts/Edit.vue';
import Show from '../views/posts/Show.vue';

Vue.use(VueRouter);

const routes = [
    {
        path: '/',
        name: 'Post',
        component: Post
    },
    {
        path: '/create',
        name: 'Create',
        component: Create
    },
    {
        path: '/edit/:id',
        name: 'Edit',
        component: Edit
    },
    {
        path: '/show/:id',
        name: 'Show',
        component: Show
    }
];

const router = new VueRouter({
    mode: 'hash',
    linkExactActiveClass: 'active',
    routes
});

export default router;