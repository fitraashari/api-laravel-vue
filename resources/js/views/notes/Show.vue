<template>
  <div class="container">
      <div class="card">
          <div class="card-header">{{note.title}}</div>
          <div class="card-body">
              <small>{{note.subject}}</small>
              <p>{{note.description}}</p></div>
          <div class="card-footer">{{note.published}}</div>
      </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            note:[]
        }
    },
    mounted(){
        // console.log(this.$route.params.noteSlug);
        this.getNote();
    },
    methods: {
        async getNote(){
            let {data} = await axios.get('/api/notes/'+this.$route.params.noteSlug);
            this.note = data.data
        }
    },
}
</script>
