<template>
  <div>
    <h1 class="text-center">Create Post 🖌️ <router-link :to="{ name: 'Post' }">List</router-link></h1>
    
    <div class="row justify-content-center">
      <div class="col-sm-6">
        <form @submit.prevent="createPost">
          <div class="form-group">
            <label>Title</label>
            <input
              type="text"
              class="form-control"
              placeholder="Enter title"
              v-model="title"
            />
          </div>
          <div class="form-group">
            <label>Description</label>
            <quill-editor
            ref="QuillEditor"
            v-model="description"
            :options="editorOption"
            @blur="onEditorBlur($event)"
            @focus="onEditorFocus($event)"
            @ready="onEditorReady($event)"
          />
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
import { mapGetters, mapActions } from "vuex";
export default {
  name: "Create",
  data () {
      return {
        title: '',
        description: '',
        editorOption: {
          content: "html",
          contentType: "html",
          placeholder: "Write something...",
          theme: "snow"
        }
      }
    },
    methods: {
      onEditorBlur(quill) {
        console.log('editor blur!', quill)
      },
      onEditorFocus(quill) {
        console.log('editor focus!', quill)
      },
      onEditorReady(quill) {
        console.log('editor ready!', quill)
      },
      onEditorChange({ quill, html, text }) {
        console.log('editor change!', quill, html, text)
        // this.content = html
      },
      createPost(){
        let post = {
          title: this.title,
          description: this.description,
          created_by: 1,
          updated_by: 1
        }
        this.$store.dispatch('add',post)
        .then(responce =>{
          this.$router.push('/');
        })
        .catch()
        
      }
    },
    computed: {
      editor() {
        return this.$refs.QuillEditor.quill
      }
    },
    mounted() {
      console.log('this is current quill instance object', this.editor)
    }
};
</script>