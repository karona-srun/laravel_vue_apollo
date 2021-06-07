<template>
  <div class="m-3">
    <h1 class="text-center m-3">
      Posts List 🖌️
      <router-link :to="{ name: 'Create' }" class="text-center"
        >Create</router-link
      >
    </h1>
    <div class="row mt-2 justify-content-center alert alert-success">
      <div class="col-sm-10">
        <div class="form-group">
          <label for="search">🔍 Search</label>
          <input
            type="text"
            class="form-control"
            placeholder="Search ..."
            v-model="search"
          />
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-10">
        <ul
          class="list-group list-group-flush"
          v-for="post in filterByPost"
          :key="post.id"
        >
          <li class="list-group-item">
            <div class="float-left">
              <router-link
                :to="{ name: 'Show', params: { id: post.id } }"
                class="text-dark"
                style="text-decoration: none"
              >
                <h5>
                  <span v-if="post.status">✅</span>
                  <span v-if="!post.status">❎</span>
                  📖 {{ post.title }}
                </h5>
              </router-link>
              <p
                v-html="post.description.substring(0, 100) + ' ...'"
                class="text-primary"
              ></p>
            </div>
            <div class="float-right">
              <router-link
                :to="{ name: 'Edit', params: { id: post.id } }"
                class="card-link"
                >Edit 📝</router-link
              >
              <a
                href="javascript:;"
                class="card-link"
                @click.prevent="deletePost(post.id)"
                >Delete 🔥</a
              >
            </div>
          </li>
        </ul>
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
          post.title.includes(this.search) ||
          post.description.includes(this.search)
        );
      });
    },
  },
  created() {
    this.$store.dispatch("loadPosts");
  },
  methods: {
    deletePost(id) {
      this.$confirm("Do you want to delete the post?.", "Question", "warning")
        .then((r) => {
          this.$store.dispatch("remove", parseInt(id));
          this.$store.dispatch("loadPosts");
        })
        .catch(() => {
          console.log("OK not selected.");
        });
    },
  },
};
</script>