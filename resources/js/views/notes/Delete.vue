<template>
    <button ref="deleteNote"  class="btn btn-sm btn-danger" @click="destroyNote">Delete</button>
</template>

<script>
export default {
    props:['endpoint'],
methods: {
    async destroyNote(){
        let c =window.confirm('Yakin ingin menghapus data?');
        if(c){
            // console.log(this.endpoint);
            let response = await axios.delete(`/api/notes/${this.endpoint}/delete`)
            // console.log(response);
            if(response.status==200){
                // this.message = response.data.message;
                this.$toasted.show(response.data.message,{
                    type:'success',
                    duration:3000
                })
            }
            this.$refs.deleteNote.parentNode.parentNode.remove();
        }
    }
},
}
</script>
