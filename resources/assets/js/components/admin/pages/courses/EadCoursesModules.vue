<template>

    <div>
        
        <h1>Módulos - {{course.name}}</h1>
        
        <v-layout row wrap>

            <v-flex sm6>
                <v-btn color="success" :to="{ name: 'admin.courses.modules.create', params: {course_id: course.id}}">
                    <i class="material-icons">add_circle</i>
                </v-btn>
            </v-flex>

            <v-flex sm6>
                <ead-search @search="searchFrom"></ead-search>
            </v-flex>

        </v-layout>
        
        <table class="table">

            <thead>

                <tr>
                    <th>NOME</th>
                    <th width="200">AÇÕES</th>
                </tr>

            </thead>

            <tbody>

                <tr v-for="(module, index) in modules.data" :key="index">
                    <td><router-link :to="{ name: 'admin.courses.modules.classrooms', params: {mid: module.id, cid: module.course.id}  }">{{ module.name }}</router-link></td>
                   
                    <td>
                        <v-layout row wrap>
                            <v-flex sm6>
                                <v-btn small flat color="info"  :to="{ name: 'admin.courses.modules.edit', params: {id: module.id}  }"><i class="material-icons">create</i></v-btn>
                            </v-flex>
                            <v-flex sm6>
                                <v-btn small flat color="error" @click.prevent="confirmDestroy(module)"><i class="material-icons">delete_sweep</i></v-btn>
                            </v-flex>
                        </v-layout>
                    </td>
                </tr>
               
            </tbody>


        </table>
        
        <ead-pagination :pagination="modules" :offset="8" @paginate="loadModules"></ead-pagination>


    </div>
  
</template>

<script>

import EadPagination from '../../../shared/EadPagination'
import EadSearch from '../../../shared/EadSearch'

export default {
  created(){
    this.loadModules()
    this.loadCourse()
  },
  data(){
      return {
          param: this.$route.params.cid,
          search: '',
          course:{
              id: '',
              name: '',
          },
      }
  },
  computed:{
      modules(){
          return this.$store.state.modules.items
      },
      params(){
            return {
                page: this.modules.current_page,
                course_id: this.param
            }
      }
  },
  methods:{

    loadCourse(){

        if(this.param){
            this.$store.dispatch('loadCourse', this.param)
                .then(response => {
                this.course = response
                })
                .catch(error => {
                    this.$snotify.error('Courso não encontrado', '404')
                    this.$router.push({ name: 'admin.courses'})
                })
        }else{
            this.$router.push({ name: 'admin.courses'})
        }
    },

    loadModules(page = 1){
        this.$store.dispatch('loadModules', {...this.params, page})
    },
    
    searchFrom(filter){
        this.search = filter
        this.loadModules(1)
    },

    confirmDestroy(course){
        this.$snotify.error(`Deseja realmente deletar o módulo ${course.name}`,'Deletar?', {
            timeout: 10000,
            showProgressBar: true,
            closeOnClick: true,
            buttons: [
                {text: 'Não', action: () => console.log('Não')},
                {text: 'Sim', action: () => this.destroy(course)}
            ]
        })
    },

    destroy(course){
        this.$store.dispatch('destroyModule', course.id)
        .then(()=>{
            this.$snotify.success(`Sucesso ao deletar o módulo: ${course.name}`)
            this.loadModules()
        })
        .catch(()=>{
            this.$snotify.error(`Erro ao deletar o curso: ${course.name}`)
        })
    },

  },
  components: {
      EadSearch,
      EadPagination,
  }
    
}
</script>

<style scoped>
.image-preview{
  max-width: 60px;
}
</style>