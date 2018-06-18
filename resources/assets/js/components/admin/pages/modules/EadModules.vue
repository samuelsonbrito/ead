<template>

    <div>
        
        <h1>Módulos</h1>
        
        <v-layout row wrap>

            <v-flex sm6>
                <v-btn color="success" :to="{ name: 'admin.modules.create'}">
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
                    <th>CURSO</th>
                    <th width="200">AÇÕES</th>
                </tr>

            </thead>

            <tbody>

                <tr v-for="(module, index) in modules.data" :key="index">
                    <td>{{ module.name }}</td>
                    <td>{{ module.course.name }}</td>
                    <td>
                        <v-layout row wrap>
                            <v-flex sm6>
                                <v-btn small flat color="info"  :to="{ name: 'admin.modules.edit', params: {id: module.id}  }"><i class="material-icons">create</i></v-btn>
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
  },
  data(){
      return {
          name: '',
          search: '',
      }
  },
  computed:{
      modules(){
          return this.$store.state.modules.items
      },
      params(){
            return {
                page: this.modules.current_page,
                filter: this.search
            }
      }
  },
  methods:{
      loadModules(page = 1){
          this.$store.dispatch('loadModules', {...this.params, page})
      },
      
      searchFrom(filter){
            this.search = filter
            this.loadModules(1)
      },
      confirmDestroy(module){
            this.$snotify.error(`Deseja realmente deletar o modulo ${module.name}`,'Deletar?', {
                timeout: 10000,
                showProgressBar: true,
                closeOnClick: true,
                buttons: [
                    {text: 'Não', action: () => console.log('Não')},
                    {text: 'Sim', action: () => this.destroy(module)}
                ]
            })
      },
      destroy(module){
          this.$store.dispatch('destroyModule', module.id)
            .then(()=>{
                this.$snotify.success(`Sucesso ao deletar o curso: ${module.name}`)
                this.loadModules()
            })
            .catch(()=>{
                this.$snotify.error(`Erro ao deletar o curso: ${module.name}`)
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