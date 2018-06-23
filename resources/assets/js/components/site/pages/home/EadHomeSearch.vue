<template>

    <div>

        <form class="form form-inline" @submit.prevent="search">

            <select class="form-control" v-model="category_id" name="categoria">
                <option value="">Selecione a Categoria</option>
                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
            </select>

            <v-text-field type="text" class="form-control mr-sm-2" v-model="filter"></v-text-field>
            
            <button type="submit" class="btn btn-outline-success">Pesquisar</button>

        </form>
        
    </div>
    
</template>

<script>
export default {
    data(){
        return {
            filter: '',
            category_id: '',
        }
    },
    created(){
        this.loadCategories()
    },
    computed:{
        categories(){
            return this.$store.state.categories.items.data
        }
    },
    methods:{
        search(){
            this.$emit('search', {
                filter: this.filter,
                category_id: this.category_id,
            })
        },
        loadCategories(){
            this.$store.dispatch('loadCategories')
        },
    }
}
</script>

<style scoped>
</style>