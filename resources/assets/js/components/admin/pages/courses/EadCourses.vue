<template>

    <div>
        
        <h1>Cursos</h1>

        <div class="row">

            <div class="col">
                <router-link :to="{ name: 'admin.courses.create'}" class="btn btn-success">Cadastrar</router-link>
            </div>

            <div class="col">
                <EadSearch @search="searchFrom"></EadSearch>
            </div>

        </div>
        
        <table class="table">

            <thead>

                <tr>
                    <th>ID</th>
                    <th>NOME</th>
                    <th>IMAGEM</th>
                    <th width="200">AÇÕES</th>
                </tr>

            </thead>

            <tbody>

                <tr v-for="(course, index) in courses.data" :key="index">
                    <td>{{ course.id }}</td>
                    <td>{{ course.name }}</td>
                    <td>
                        <div v-if="course.image">
                            <img :src="[`/storage/courses/${course.image}`]" class="image-preview" alt="">
                        </div>
                    </td>
                    <td>
                        <router-link :to="{ name: 'admin.courses.edit', params: {id: course.id}  }" class="btn btn-primary">Editar</router-link>

                        <a href="" class="btn btn-danger" @click.prevent="confirmDestroy(course)">Deletar</a>
                    </td>
                </tr>
               
            </tbody>


        </table>
        
        <EadPagination :pagination="courses" :offset="8" @paginate="loadCourses"></EadPagination>


    </div>
  
</template>

<script>

import EadPagination from '../../../shared/EadPagination'
import EadSearch from '../../shared/EadSearch'

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