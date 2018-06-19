<template>
  
  <div>
      <h1 v-if="this.module.id">Atualizar Módulo</h1>
      <h1 v-else>Cadastro de Módulo</h1>

      <form class="form" @submit.prevent="onSubmit">
        <div :class="['form-group', { 'has-error': errors.name }]">
          <span v-if="errors.name">{{ errors.name[0] }}</span>
          <v-text-field type="text" v-model="module.name" class="form-control" label="Nome da categoria"></v-text-field>
        </div>

        <div :class="['form-group', { 'has-error': errors.description }]">
          <span v-if="errors.description">{{ errors.description[0] }}</span>
          <v-text-field type="text" v-model="module.description" class="form-control" label="Descrição"></v-text-field>
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
      module:{
        id: '',
        name: '',
        description: '',
        course_id: this.$route.params.cid,
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
        this.$store.dispatch('loadModule', this.param)
            .then(response => this.module = response)
            .catch(error => {
                this.$snotify.error('Categoria não encontrada', '404')
                this.$router.push({ name: 'admin.categories'})
            })
      }
    },
    onSubmit(){
      this.$store.dispatch('storeModule', this.module)
        .then(() => {
          this.$snotify.success('Salvo com sucesso')
          this.$router.push({ name: 'admin.courses.modules', params: {cid: this.module.course_id}})
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