<template>

    <div>

        <form class="form form-inline" @submit.prevent="search">

            <input type="text" class="form-control mr-sm-2" v-model="filter">
            
            <button type="submit" class="btn btn-outline-success">Pesquisar</button>

        </form>
        
    </div>
    
</template>

<script>
export default {
    data(){
        return {
            filter: ''
        }
    },
    methods:{
        search(){
            this.$emit('search',this.filter)
        }
    }
}
</script>

<style scoped>
</style>