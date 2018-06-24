<template>

    <div>
        
        <h1>Módulos - {{course.name}}</h1>
        
        <v-layout row wrap>

            <v-flex sm6>
                <v-btn color="success">
                    <i class="material-icons">add_circle</i>
                </v-btn>
            </v-flex>

            <v-flex sm6>
               
            </v-flex>

        </v-layout>
        
        <div>
            {{ course.id }}
            <br>
            {{ course.name }}

            <div v-for="(module, index) in course.modules" :key="index">
                {{ module.name }}
                <br>
                <div v-for="(classroom, index2) in module.classrooms" :key="index2">
                    {{ classroom.name }}
                    <br>
                </div>
            </div>
        </div>
        
        <ead-pagination :pagination="mySales" :offset="8" @paginate="loadMySales"></ead-pagination>


    </div>
  
</template>

<script>

import EadPagination from '../../../shared/EadPagination'

export default {
  created(){
    this.loadMySales()
    this.loadMyCourse()
  },
  data(){
      return {
          param: this.$route.params.url,
          search: '',
          course:{},
      }
  },
  computed:{
      mySales(){
          return this.$store.state.sales.items
      },
      params(){
            return {
                page: this.mySales.current_page,
                url: this.param
            }
      }
  },
  methods:{

    loadMySales(page = 1){
        this.$store.dispatch('loadMySales', {...this.params, page})
    },
    
    searchFrom(filter){
        this.search = filter
        this.loadMySales(1)
    },

    loadMyCourse(){

        if(this.param){
            this.$store.dispatch('loadMyCourse', this.param)
                .then(response => {
                    this.course = response
                    console.log(this.course);
                })
                .catch(error => {
                    this.$snotify.error('Categoria não encontrada', '404')
                    this.$router.push({ name: 'campus.courses'})
                })
        }
    },


  },
  components: {
      EadPagination,
  }
    
}
</script>

<style scoped>
.image-preview{
  max-width: 60px;
}
</style>