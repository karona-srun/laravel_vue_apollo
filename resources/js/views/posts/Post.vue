<template>
  <div>
    <h1 class="text-center">
      Posts List 🖌️
      <router-link :to="{ name: 'Create' }" class="text-center"
        >Create</router-link
      >
    </h1>
    <div class="row mt-2 justify-content-center">
      <div class="col-sm-6">
        <div class="form-group">
          <label for="search"> Search</label>
          <input
            type="text"
            class="form-control"
            placeholder="Search ..."
            v-model="search"
          />
        </div>
      </div>
    </div>
    <div class="row mt-3 justify-content-center">
      <div class="col-sm-12 col-lg-3 col-md-6 mb-2" v-for="post in filterByPost"
      :key="post.id">
        <router-link
          :to="{ name: 'Show', params: { id: post.id } }"
          class="text-dark"
          style="text-decoration: none"
        >
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ post.title }}</h5>
              <p class="card-text" v-html="post.description">
              </p>
              <router-link
                :to="{ name: 'Edit', params: { id: post.id } }"
                class="card-link"
                >Edit 📝</router-link
              >
              <a href="javascript:;" class="card-link" @click.prevent="deletePost(post.id)">Delete 🔥</a>
            </div>
          </div></router-link
        >
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  name: "Post",
  data() {
    return {
      search: "",
    };
  },
  computed: {
    ...mapGetters(["posts"]),
    filterByPost() {
      return this.posts.filter((post) => {
        return (
          post.title.toLowerCase().includes(this.search) ||
          post.description.toLowerCase().includes(this.search)
        );
      });
    },
    
  },
  created() {
    this.$store.dispatch("loadPosts");
  },
  methods:{
    deletePost(id){
      this.$store.dispatch("remove",id) 
      this.$store.dispatch("loadPosts");
      
    }
  }
};
</script>