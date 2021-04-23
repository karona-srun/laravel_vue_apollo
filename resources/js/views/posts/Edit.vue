<template>
  <div>
    <h1 class="text-center">Edit Post 🖌️ <router-link :to="{ name: 'Post' }">List</router-link></h1>
    
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form @submit.prevent="editPost">
          <div class="form-group">
            <label>Title</label>
            <input
              type="text"
              class="form-control"
              placeholder="Enter title"
              v-model="post.title"
            />
          </div>
          <div class="form-group">
            <label>Description</label>
            <quill-editor
            ref="QuillEditor"
            :options="editorOption"
            v-model="post.description"
          />
          </div>
          <div class="form-group">
              <label>Status</label>
              <select v-model="post.status" class="form-control">
                  <option value="0">Draft</option>
                  <option value="1">Published</option>
              </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</template>
<style>
.ql-editor{
  height: 40vh !important;
}
</style>
<script>
import {mapGetters} from 'vuex';
export default {
  name: "Edit",
  data () {
      return {
        editorOption: {
        },
        title: '',
        description: '',
        status: ''
      }
    },
    methods: {
      editPost(){
        let data = {
          id: parseInt(this.$route.params.id),
          title: this.post.title,
          description: this.post.description,
          status: this.post.status,
          created_by: 1,
          updated_by: 1
        }
        this.$store.dispatch('update', data)
        .then(responce =>{
          this.$router.push('/');
        })
        .catch()
      }
    },
    computed: {
      editor() {
        return this.$refs.QuillEditor.quill
      },
      ...mapGetters(['post'])
    },
    mounted() {
      this.$store.dispatch("getPostByID",this.$route.params.id);
    }
};
</script>