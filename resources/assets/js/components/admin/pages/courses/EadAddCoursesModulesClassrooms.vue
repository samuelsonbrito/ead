<template>
  
  <div>
      <h1 v-if="this.classroom.id">Atualizar Aula</h1>
      <h1 v-else>Cadastro de Aula</h1>

      <form class="form" @submit.prevent="onSubmit">
        <div :class="['form-group', { 'has-error': errors.name }]">
          <span v-if="errors.name">{{ errors.name[0] }}</span>
          <v-text-field type="text" v-model="classroom.name" class="form-control" label="Nome da categoria"></v-text-field>
        </div>

        <div :class="['form-group', { 'has-error': errors.description }]">
          <span v-if="errors.description">{{ errors.description[0] }}</span>
          <v-text-field type="text" v-model="classroom.description" class="form-control" label="Descrição"></v-text-field>
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
      classroom:{
        id: '',
        name: '',
        description: '',
        module_id: this.$route.params.mid,
      },
      errors: {}
    }
  },
  created(){
    this.loadModule()
  },
  methods:{
    loadModule(){
      if(this.param){
        this.$store.dispatch('loadClassroom', this.param)
            .then(response => this.classroom = response)
            .catch(error => {
                this.$snotify.error('Categoria não encontrada', '404')
                this.$router.push({ name: 'admin.categories'})
            })
      }
    },
    onSubmit(){
      this.$store.dispatch('storeClassroom', this.classroom)
        .then(() => {
          this.$snotify.success('Salvo com sucesso')
          this.$router.push({ name: 'admin.courses.modules.classrooms', params: {mid: this.classroom.module_id}})
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