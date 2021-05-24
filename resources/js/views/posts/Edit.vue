<template>
  <div>
    <h1 class="text-center">Edit Post 🖌️ <router-link :to="{ name: 'Post' }">List</router-link></h1>
    
    <div class="row justify-content-center">
      <div class="col-sm-10">
        <form @submit.prevent="editPost">
          <div class="form-group">
            <label>Title<span class="text-danger">*</span></label>
            <input
              type="text"
              class="form-control"
              placeholder="Enter title"
              v-model="post.title"
            />
          </div>
          <div class="form-group">
            <label>Description<span class="text-danger">*</span></label>
            <quill-editor
            ref="QuillEditor"
            :options="editorOption"
            v-model="post.description"
          />
          </div>
          <div class="form-group">
              <label>Status</label>
              <select v-model="post.status" class="form-control">
                  <option :value='false'>Draft</option>
                  <option :value='true'>Published</option>
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
        status: false
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
        console.log(data);
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
      this.$store.dispatch("getPostByID", parseInt(this.$route.params.id));
    }
};
</script>