<template>
  
  <div>
      <h1 v-if="this.category.id">Atualizar Categoria</h1>
      <h1 v-else>Cadastro de Categoria</h1>

      <form class="form" @submit.prevent="onSubmit">
        <div :class="['form-group', { 'has-error': errors.name }]">
          <span v-if="errors.name">{{ errors.name[0] }}</span>
          <v-text-field type="text" v-model="category.name" class="form-control" label="Nome da categoria"></v-text-field>
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
      category:{
        id: '',
        name: '',
      },
      errors: {}
    }
  },
  created(){
    this.loadCategory()
  },
  methods:{
    loadCategory(){
      if(this.param){
        this.$store.dispatch('loadCategory', this.param)
            .then(response => this.category = response)
            .catch(error => {
                this.$snotify.error('Categoria não encontrada', '404')
                this.$router.push({ name: 'admin.categories'})
            })
      }
    },
    onSubmit(){
      this.$store.dispatch('storeCategory', this.category)
        .then(() => {
          this.$snotify.success('Salvo com sucesso')
          this.$router.push({ name: 'admin.categories'})
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