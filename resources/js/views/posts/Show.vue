<template>
  <div>
    <h1 class="text-center m-5">
      Show 🖌️<router-link :to="{ name: 'Post' }">List</router-link>
    </h1>
    <div class="row">
      <div class="col-sm-12">
        <div class="card bg-white">
          <div class="card-body">
            <h1 class="card-title"> 📖 {{ post.title }}</h1>
            <p class="card-title" v-html="post.description">
            </p>
            <div>
              <p class="text-dark" v-if="post.created_by">
                <span class="h2"> 🧑‍💻</span> {{ post.created_by.first_name }} {{ post.created_by.last_name }} <br>
                <span class="h4"> 📞</span> {{ post.created_by.tel }} <br>
                <span class="h4"> 📧</span> {{ post.created_by.email }}
              </p>
              <p class="text-dark">Created At: {{ post.created_at }}</p>
              <p class="text-dark">Updated At: {{ post.updated_at }}</p>
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
  created() {
    this.$store.dispatch("getPostByID", parseInt(this.$route.params.id));
  },
};
</script>