<template>

    <div>
        
        <h1>Cursos</h1>
        
        <v-layout row wrap>

            <v-flex sm6>
                <v-btn color="success" :to="{ name: 'admin.courses.create'}">
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
                    <th>CATEGORIA</th>
                    <th>IMAGEM</th>
                    <th width="200">AÇÕES</th>
                </tr>

            </thead>

            <tbody>

                <tr v-for="(course, index) in courses.data" :key="index">
                    <td><router-link :to="{ name: 'admin.courses.modules', params: {cid: course.id}  }">{{ course.name }}</router-link></td>
                    <td>{{ course.category.name }}</td>
                    <td>
                        <div v-if="course.image">
                            <img :src="[`/storage/courses/${course.image}`]" class="image-preview" alt="">
                        </div>
                    </td>
                    <td>
                        <v-layout row wrap>
                            <v-flex sm6>
                                <v-btn small flat color="info"  :to="{ name: 'admin.courses.edit', params: {id: course.id}  }"><i class="material-icons">create</i></v-btn>
                            </v-flex>
                            <v-flex sm6>
                                <v-btn small flat color="error" @click.prevent="confirmDestroy(course)"><i class="material-icons">delete_sweep</i></v-btn>
                            </v-flex>
                        </v-layout>
                    </td>
                </tr>
               
            </tbody>


        </table>
        
        <ead-pagination :pagination="courses" :offset="8" @paginate="loadCourses"></ead-pagination>


    </div>
  
</template>

<script>

import EadPagination from '../../../shared/EadPagination'
import EadSearch from '../../../shared/EadSearch'

export default {
  created(){
    this.loadCourses()
  },
  data(){
      return {
          name: '',
          search: '',
      }
  },
  computed:{
      courses(){
          return this.$store.state.courses.items
      },
      params(){
            return {
                page: this.courses.current_page,
                filter: this.search
            }
      }
  },
  methods:{
      loadCourses(page = 1){
          this.$store.dispatch('loadCourses', {...this.params, page})
      },
      
      searchFrom(filter){
            this.search = filter
            this.loadCourses(1)
      },
      confirmDestroy(course){
            this.$snotify.error(`Deseja realmente deletar o curso ${course.name}`,'Deletar?', {
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
          this.$store.dispatch('destroyCourse', course.id)
            .then(()=>{
                this.$snotify.success(`Sucesso ao deletar o curso: ${course.name}`)
                this.loadCourses()
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