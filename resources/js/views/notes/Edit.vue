<template>
  <div class="container">
      <div class="row">
          <div class="col-md-6">
              <!-- <div v-if="message" class="alert alert-success">{{message}}</div> -->
              <div class="card">
                  <div class="card-header">
                      New Note
                  </div>
                  <div class="card-body">
                      <form action="#" method="post" @submit.prevent="store">
                          <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" id="title" v-model="form.title" class="form-control">
                              <small v-if="errors.title" class="text-danger">{{errors.title[0]}}</small>
                          </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <select @change="selectedSubject" id="subject" class="form-control">
                                    <option :value="form.subject_id">{{form.subject}}</option>
                                    <template v-for="subject in subjects" >
                                        <option v-if="form.subject_id!==subject.id" :key="subject.id" :value="subject.id">{{subject.name}}</option>
                                    </template>
                                </select>
                              <small v-if="errors.subject_id" class="text-danger">{{errors.subject_id[0]}}</small>

                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea v-model="form.description" id="description" rows="5" class="form-control"></textarea>
                              <small v-if="errors.description" class="text-danger">{{errors.description[0]}}</small>

                            </div>
                            <button type="submit" class="btn btn-primary d-flex align-items-center">Update
                                <template v-if="loading">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: none; display: block; shape-rendering: auto;" width="20px" height="20px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"> <rect x="17.5" y="30" width="15" height="40" fill="#93dbe9"> <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="18;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate> <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="64;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.2s"></animate> </rect> <rect x="42.5" y="30" width="15" height="40" fill="#689cc5"> <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate> <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1" begin="-0.1s"></animate> </rect> <rect x="67.5" y="30" width="15" height="40" fill="#5e6fa3"> <animate attributeName="y" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="20.999999999999996;30;30" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate> <animate attributeName="height" repeatCount="indefinite" dur="1s" calcMode="spline" keyTimes="0;0.5;1" values="58.00000000000001;40;40" keySplines="0 0.5 0.5 1;0 0.5 0.5 1"></animate> </rect> </svg>
                                    
                                </template>
                            </button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
    data(){
        return{
            form:[],
            subjects:[],
            errors:[],
            // message:'',
            selected:'',
            loading:false
        }
    },
    mounted(){
        this.getSubjects();
        this.getNote();
    },
    methods: {
        async getSubjects(){
            let response = await axios.get('/api/subjects');
            // console.log(response.status);
            if(response.status === 200){
                this.subjects = response.data
            }
        },
        async store(){
            this.loading = true;
            try {
            let response = await axios.patch(`/api/notes/${this.$route.params.noteSlug}/update`,this.form);
            if(response.status==200){
                this.errors=[];
                console.log(response.data)
                // this.message = response.data.message;
                this.$toasted.show(response.data.message,{
                    type:'success',
                    duration:5000
                })
                this.loading=false;
                this.$router.push('/notes/table');
            }   
            } catch (e) {
                this.$toasted.show('Error, Periksa kembali form yang anda kirimkan, atau tunggu beberapa saat lagi',{
                    type:'error',
                    duration:5000
                })
                this.loading=false;
               this.errors =  e.response.data.errors;
            }
        },
        async getNote(){
            
            let {data} = await axios.get(`/api/notes/${this.$route.params.noteSlug}`);
            this.form = data.data;
        },
        selectedSubject(s){
          this.selected =  s.target.value;
          this.form.subject_id = this.selected;
        }
    },
}
</script>