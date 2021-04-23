<template>
  <div>
    <h1 class="text-center">
      Show 🖌️<router-link :to="{ name: 'Post' }">List</router-link>
    </h1>
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title">{{ post.title }}</h1>
            <p class="card-title" v-html="post.description">
            </p>
            <div>
              <p class="text-info">{{ post.created_at }}</p>
              <p class="text-info">{{ post.updated_at }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  name: "ShowPost",
  computed: {
    ...mapGetters(["post"]),
  },
  mounted() {
    this.$store.dispatch("getPostByID", parseInt(this.$route.params.id));
  },
};
</script>