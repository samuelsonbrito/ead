<template>
    <div>
        <h1>Cursos</h1>

        <ead-home-search @search="search"></ead-home-search>

        <div class="row">
            <ead-item v-for="course in courses.data" 
            :key="course.id"
            :item="course"
            :path="'courses'">
            </ead-item>
            <hr>
        </div>

        <div class="row">
            <ead-pagination :pagination="courses" @paginate="loadCourses"></ead-pagination>
        </div>
    </div>
</template>

<script>
import EadPagination from '../../../shared/EadPagination'
import EadItem from '../../../shared/EadItem'
import EadHomeSearch from './EadHomeSearch'

export default {

    data(){
        return {
            filter: '',
            category_id: '',
        }
    },
    created(){
        if(this.courses.data.length == 0)
            this.$store.dispatch('loadCourses', {})
    },
    computed:{
        courses(){
            return this.$store.state.courses.items
        },

        params(){
            return {
                filter: this.filter,
                category_id: this.category_id,
                page: this.courses.current_page,
            }
        },
    },
    methods:{
        loadCourses(page = 1){
            this.$store.dispatch('loadCourses', {...this.params, page})
        },

        search(values){
            this.filter = values.filter
            this.category_id = values.category_id
            this.loadCourses()
        },
    },
    components:{
        EadPagination,
        EadItem,
        EadHomeSearch,
    }
}
</script>

<style scoped>

</style>
