<template>

    <div>
        
        <h1>Listagem de Categorias</h1>
        <v-layout row wrap>

            <v-flex sm6>
                <v-btn color="success" :to="{ name: 'admin.categories.create'}">
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

                <tr v-for="(category, index) in categories.data" :key="index">
                    <td>{{ category.name }}</td>
                    <td>
                        <v-layout row wrap>
                            <v-flex sm6>
                                <v-btn small flat color="info"  :to="{ name: 'admin.categories.edit', params: {id: category.id}  }"><i class="material-icons">create</i></v-btn>
                            </v-flex>
                            <v-flex sm6>
                                <v-btn small flat color="error" @click.prevent="confirmDestroy(category)"><i class="material-icons">delete_sweep</i></v-btn>

                            </v-flex>
                        </v-layout>
                    </td>
                </tr>
               
            </tbody>


        </table>
        
        <ead-pagination :pagination="categories" :offset="10" @paginate="loadCategories"></ead-pagination>


    </div>
  
</template>

<script>

import EadPagination from '../../../shared/EadPagination'
import EadSearch from '../../../shared/EadSearch'

export default {
  created(){
    this.loadCategories()
  },
  data(){
      return {
          name: '',
          search: '',
      }
  },
  computed:{
      categories(){
          return this.$store.state.categories.items
      },
      params(){
            return {
                page: this.categories.current_page,
                filter: this.search
            }
      }
  },
  methods:{
      loadCategories(page = 1){
          this.$store.dispatch('loadCategories', {...this.params, page})
      },
      
      searchFrom(filter){
            this.search = filter
            this.loadCategories(1)
      },
      confirmDestroy(category){
            this.$snotify.error(`Deseja realmente deletar a categoria ${category.name}`,'Deletar?', {
                timeout: 10000,
                showProgressBar: true,
                closeOnClick: true,
                buttons: [
                    {text: 'Não', action: () => console.log('Não')},
                    {text: 'Sim', action: () => this.destroy(category)}
                ]
            })
      },
      destroy(category){
          this.$store.dispatch('destroyCategory', category.id)
            .then(()=>{
                this.$snotify.success(`Sucesso ao deletar a categoria: ${category.name}`)
                this.loadCategories()
            })
            .catch(()=>{
                this.$snotify.error(`Erro ao deletar a categoria: ${category.name}`)
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
</style>