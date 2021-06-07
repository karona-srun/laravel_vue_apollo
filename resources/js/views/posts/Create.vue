<template>
  <div>
    <h1 class="text-center">
      Create Post 🖌️ <router-link :to="{ name: 'Post' }">List</router-link>
    </h1>

    <div class="row justify-content-center">
      <div class="col-sm-10">
        <form @submit.prevent="createPost">
          <div class="form-group">
            <label>Title<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              placeholder="Enter title"
              v-model="title"
              required
            />
          </div>
          <div class="form-group">
            <label>Description<span class="text-danger">*</span></label>
            <quill-editor
              ref="QuillEditor"
              v-model="description"
              :options="editorOption"
            />
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>
<style>
.ql-editor {
  height: 40vh !important;
}
</style>
<script>
export default {
  name: "Create",
  data() {
    return {
      title: "",
      description: "",
      editorOption: {
        content: "html",
        contentType: "html",
        placeholder: "Write something...",
        theme: "snow",
      },
      errors: [],
    };
  },
  methods: {
    createPost() {
      let post = {
        title: this.title,
        description: this.description,
        created_by: 1,
        updated_by: 1,
      };
      this.$store
        .dispatch("add", post)
        .then((responce) => {
          this.$alert(
            "The post has been created successfully.",
            "Success",
            "success"
          ).then(() => {
            console.log("Closed");
            this.$router.push("/");
          });
        })
        .catch((e) => {
          console.error(e.message);
        });
    },
  },
  computed: {
    editor() {
      return this.$refs.QuillEditor.quill;
    },
  },
};
</script>