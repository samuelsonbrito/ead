<template>
  
  <div>
      <h1 v-if="this.course.id">Atualizar Curso</h1>
      <h1 v-else>Cadastro de Curso</h1>

      <form class="form" @submit.prevent="onSubmit">
        <div :class="['form-group', { 'has-error': errors.name }]">
          <span v-if="errors.name">{{ errors.name[0] }}</span>
          <input type="text" v-model="course.name" class="form-control" placeholder="Nome do Curso">
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>

  </div>
</template>

<script>
export default {
  data(){
    return{
      param: this.$route.params.id,
      course:{
        id: '',
        name: '',
        user_id: 1,
        category_id: 1
      },
      errors: {}
    }
  },
  created(){
    this.loadCourse()
  },
  methods:{
    loadCourse(){
      if(this.param){
        this.$store.dispatch('loadCourse', this.param)
            .then(response => this.course = response)
            .catch(error => {
                this.$snotify.error('Courso não encontrado', '404')
                this.$router.push({ name: 'admin.courses'})
            })
      }
    },
    onSubmit(){
      this.$store.dispatch('storeCourse', this.course)
        .then(() => {
          this.$snotify.success('Salvo com sucesso')
          this.$router.push({ name: 'admin.courses'})
        })
        .catch((error)=>{
          this.$snotify.error('Erro ao salvar')
          this.errors = error.response.data.errors
        })
    },
  },
}
</script>

<style scoped>
.has-error{
  color: red
}
.has-error input{
  border: 1px solid red
}
</style>