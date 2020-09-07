<template>
    <div class="container">
        <h5>Table of Notes</h5>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>
                        Title
                    </th>
                    <th>
                        Subject
                    </th>
                    <th>
                        Published
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(note,index) in notes" :key="note.id">
                    <td>{{index+1}}</td>
                    <td><router-link :to="{ name:'notes.show', params: {noteSlug: note.slug } }">{{note.title}}</router-link></td>
                    <td>{{note.subject}}</td>
                    <td>{{note.published}}</td>
                    <td><router-link class="btn btn-sm btn-primary" :to="{ name:'notes.edit', params: {noteSlug: note.slug } }">Edit</router-link> <delete-note :endpoint="note.slug"/></td>
                    <!-- <td><router-link to="note.link" class="btn btn-sm btn-primary">Detail</router-link></td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import DeleteNote from './Delete';
export default {
    components:{
        DeleteNote
    },
    data(){
        return{
            notes:[]
        }
    },
    mounted(){
        // axios.get('/api/notes').then((response)=>{
        //     this.notes = response.data.data
        //     console.log(response.data.data);
        // })
        this.getNotes();
    },
    methods: {
        async getNotes(){
            let {data} = await axios('/api/notes');
            this.notes = data.data;
        }
    },
}
</script>
