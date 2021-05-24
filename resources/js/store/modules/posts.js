import { apolloClient } from "../../apollo/index";

import Vue from "vue";
import Vuex from "vuex";
// import axios from 'axios'

import { POSTS,FETCH_POST,CREATE_POST,UPDATE_POST,DELETE_POST, } from '../../graphql/post'

Vue.use(Vuex)

const state = {
    posts: [],
    post: []
};
const getters = {
    posts: state => {
        return state.posts
    },
    post: state => {
        return state.post
    }
};
const actions = {
    loadPosts({
        commit
    }){
        apolloClient.query({
            query: POSTS
        }).then(response => {
            commit('setPosts',response.data.posts)
            console.log('🚀🚀 loadPosts from actions');
        });
    },

    getPostByID({ commit }, id){
        apolloClient.query({
            query: FETCH_POST,
            variables:{
                id: id
            }
        }).then(response => {
            commit('setPost',response.data.post)
        });
    },

    add({commit}, post){
        apolloClient.mutate({
            mutation: CREATE_POST,
            variables:{
                ...post
            }
        }).then(response => {
            commit("addPost", response.data.createPost);
        })
        .catch()
    },
    update({commit}, post){
        apolloClient.mutate({
            mutation: UPDATE_POST,
            variables:{
                ...post
            }
        }).then(response => {
            commit("updatePost", response.data.updatePost);
            
        }).catch()
    },
    remove({commit}, id){
        apolloClient.mutate({
            mutation: DELETE_POST,
            variables:{
                id
            }
        }).then(response => {
            commit('deletePost',id);
        })
        .catch()
    },

    // loadPosts({ commit }) {
    //     axios.get("/api/posts")
    //     .then(response => {
    //         commit("setPosts", response.data.posts);
    //     })
    //     .catch();
    // },
    
    // getPostByID({ commit }, id){
    //     axios.get("/api/posts/"+id)
    //     .then(response => {
    //         commit("setPost", response.data.post);
    //     })
    //     .catch();
    // },
    // add({commit}, post){
    //     axios.post("/api/posts",post)
    //     .then(response => {
    //         commit("addPost", response.data.post);
    //     })
    //     .catch()
    // },
    // update({commit}, post){
    //     axios.patch("/api/posts/"+post.id,post)
    //     .then(response => {
    //         commit("updatePost", response.data.post);
    //     })
    //     .catch()
    // },
    // remove({commit}, id){
    //     axios.delete("/api/posts/"+id)
    //     .then(response => { 
    //         commit('deletePost',id);
    //     })
    //     .catch()
    // }
};
const mutations = {
    setPosts(state, posts){ state.posts = posts },
    setPost(state, post){ state.post = post },
    addPost(state, post){
        state.posts.push(post);
    },
    updatePost(state, data){
        state.posts = state.posts.map(post => {
            if (post.id === data.id) {
              return Object.assign({}, post, data.data)
            }
            return post
        })
    },
    deletePost(state, id){
        var index = state.posts.findIndex(post => post.id === id)
        state.posts.splice(index, 1)
    }
};

export default {
    state,
    getters,
    actions,
    mutations
}
