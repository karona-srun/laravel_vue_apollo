import Vue from "vue";
import Vuex from "vuex";
import axios from 'axios'

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
    loadPosts({ commit }) {
        axios.get("/api/posts")
        .then(response => {
            commit("setPosts", response.data.posts);
        })
        .catch();
    },
    getPostByID({ commit }, id){
        axios.get("/api/posts/"+id)
        .then(response => {
            commit("setPost", response.data.post);
        })
        .catch();
    },
    add({commit}, post){
        axios.post("/api/posts",post)
        .then(response => {
            commit("addPost", response.data.post);
        })
        .catch()
    },
    update({commit}, post){
        axios.patch("/api/posts/"+post.id,post)
        .then(response => {
            commit("updatePost", response.data.post);
        })
        .catch()
    },
    remove({commit}, id){
        axios.delete("/api/posts/"+id)
        .then(response => { 
            commit('deletePost',id);
        })
        .catch()
    }
};
const mutations = {
    setPosts(state, posts){ state.posts = posts},
    setPost(state, post){ state.post = post},
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
