<template>

    <div>
        
        <h1>Aulas - Módulo: {{module.name}}  </h1>
        
        <v-layout row wrap>

            <v-flex sm6>
                <v-btn color="success" :to="{ name: 'admin.courses.modules.classrooms.create', params: {module_id: module.id}}">
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

                <tr v-for="(module, index) in classrooms.data" :key="index">
                    <td><router-link :to="{ name: 'admin.courses.modules', params: {id: module.id}  }">{{ module.name }}</router-link></td>
                   
                    <td>
                        <v-layout row wrap>
                            <v-flex sm6>
                                <v-btn small flat color="info"  :to="{ name: 'admin.courses.modules.classrooms.edit', params: {id: module.id}  }"><i class="material-icons">create</i></v-btn>
                            </v-flex>
                            <v-flex sm6>
                                <v-btn small flat color="error" @click.prevent="confirmDestroy(module)"><i class="material-icons">delete_sweep</i></v-btn>
                            </v-flex>
                        </v-layout>
                    </td>
                </tr>
               
            </tbody>


        </table>
        
        <ead-pagination :pagination="classrooms" :offset="8" @paginate="loadClassrooms"></ead-pagination>


    </div>
  
</template>

<script>

import EadPagination from '../../../shared/EadPagination'
import EadSearch from '../../../shared/EadSearch'

export default {
  created(){
    this.loadModule()
    this.loadClassrooms()
  },
  data(){
      return {
          param: this.$route.params.cid,
          mid: this.$route.params.mid,
          search: '',
          course:{
              id: '',
              name: '',
          },
          module:{
              id: '',
              name: '',
              course: {}
          },
          classroom:{
              id: '',
              name: ''
          }
      }
  },
  computed:{
      classrooms(){
          return this.$store.state.classrooms.items
      },
      params(){
            return {
                page: this.classrooms.current_page,
                module_id: this.mid
            }
      }
  },
  methods:{

    loadModule(){

        if(this.mid){
            this.$store.dispatch('loadModule', this.mid)
                .then(response => {
                this.module = response
                console.log('Isso: ')
                console.log(response)
                })
                .catch(error => {
                    this.$snotify.error('Courso não encontrado', '404')
                    this.$router.push({ name: 'admin.courses'})
                })
        }else{
            this.$router.push({ name: 'admin.courses'})
        }
    },

    loadClassrooms(page = 1){
        this.$store.dispatch('loadClassrooms', {...this.params, page})
    },
    
    searchFrom(filter){
        this.search = filter
        this.loadClassrooms(1)
    },

    confirmDestroy(course){
        this.$snotify.error(`Deseja realmente deletar a aula ${course.name}`,'Deletar?', {
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
        this.$store.dispatch('destroyClassroom', course.id)
        .then(()=>{
            this.$snotify.success(`Sucesso ao deletar a aula: ${course.name}`)
            this.loadClassrooms()
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