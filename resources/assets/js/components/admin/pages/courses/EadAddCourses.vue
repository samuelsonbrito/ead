<template>
  
  <div>
      <h1 v-if="this.course.id">Atualizar Curso</h1>
      <h1 v-else>Cadastro de Curso</h1>

      <form class="form" @submit.prevent="onSubmit">

        <div :class="['form-group', { 'has-error': errors.image }]">
          <span v-if="errors.image">{{ errors.image[0] }}</span>

          <div v-if="imagePreview" class="text-center">
            <img :src="imagePreview" class="image-preview">
            <button class="btn btn-danger" @click.prevent="removePreviewImage">X</button>
          </div>
          
          <div v-else>
            <input type="file" class="form-control" @change="onFileChange">
          </div>
        </div>

        <div :class="['form-group', { 'has-error': errors.name }]">
          <span v-if="errors.name">{{ errors.name[0] }}</span>
          <v-text-field type="text" v-model="course.name" class="form-control" label="Nome do curso"></v-text-field>
        </div>

        <v-select
          :items="categories"
          label="Selecione a Categoria"
          single-line
          item-text="name"
          v-model="course.category_id"
          item-value="id"
        ></v-select>

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
        user_id: '',
        category_id: '',
      },
      errors: {},
      upload: null,
      imagePreview: null,
    }
  },
  created(){
    this.loadCategories()
    this.loadCourse()

  },
  computed:{
    categories(){
      return this.$store.state.categories.items.data
    }
  },
  methods:{
    loadCategories(){
      this.$store.dispatch('loadCategories')
    },
    loadCourse(){
      if(this.param){
        this.$store.dispatch('loadCourse', this.param)
            .then(response => {
              this.course = response
            })
            .catch(error => {
                this.$snotify.error('Courso não encontrado', '404')
                this.$router.push({ name: 'admin.courses'})
            })
      }
    },
    onSubmit(){

      const formData = new FormData()

      if(this.upload != null)
        formData.append('image', this.upload)

      formData.append('id', this.course.id)
      formData.append('name', this.course.name)
      formData.append('user_id', this.course.user_id)
      formData.append('category_id', this.course.category_id)

      this.$store.dispatch('storeCourse', formData)
        .then(() => {
          this.$snotify.success('Salvo com sucesso')
          this.$router.push({ name: 'admin.courses'})
        })
        .catch((error)=>{
          this.$snotify.error('Erro ao salvar')
          this.errors = error.response.data.errors
        })
    },

    onFileChange(e){
      let files = e.target.files || e.dataTransfer.files
      if(!files.length)
        return

      this.upload = files[0]

      this.previewImage(files[0])
    },

    previewImage(file){
      let reader = new FileReader();
      reader.onload = (e) =>{
        this.imagePreview = e.target.result
      }
      reader.readAsDataURL(file)
    },

    removePreviewImage(){
      this.imagePreview = null
      this.upload = null
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
.image-preview{
  max-width: 60px;
}
</style>