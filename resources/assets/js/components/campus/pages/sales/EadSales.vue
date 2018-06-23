<template>

    <div>
        
        <h1>Meus cursos</h1>
        <v-layout row wrap>

            <v-flex sm6>
                
            </v-flex>

            <v-flex sm6>
                
            </v-flex>

        </v-layout>
        
        <table class="table">

            <thead>

                <tr>
                    <th>NOME</th>
                </tr>

            </thead>

            <tbody>

                <tr v-for="(sale, index) in mySales.data" :key="index">

                    <td>
                    
                        <router-link :to="{name: 'campus.courses.sales',params: {url: sale.course.url}}">{{ sale.course.name }}</router-link>
                    
                    </td>
                
                </tr>
               
            </tbody>


        </table>
  
       <ead-pagination :pagination="mySales" :offset="10" @paginate="loadMySales"></ead-pagination>


    </div>
  
</template>

<script>

import EadPagination from '../../../shared/EadPagination'
import EadSearch from '../../../shared/EadSearch'

export default {
  created(){
    this.loadMySales()
  },
  data(){
      return {
          name: '',
          search: '',
      }
  },
  computed:{
      mySales(){
          return this.$store.state.sales.items
      },
      params(){
            return {
                page: this.mySales.current_page,
                filter: this.search
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
                this.loadMySales()
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