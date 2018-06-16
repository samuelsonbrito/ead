<template>

    <div>

        <v-layout row>
            <v-flex sm4>
                <v-text-field type="text" v-model="filter" label="Pesquisa"></v-text-field>
            </v-flex>
            <v-flex sm2>
                <v-btn color="info" @click.prevent="search">
                    <i class="material-icons">search</i>
                </v-btn>
            </v-flex>
        </v-layout>
        
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