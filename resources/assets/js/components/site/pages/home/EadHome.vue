<template>
    <div>
        <h1>Cursos</h1>

        <ead-search @search="search"></ead-search>

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
import EadSearch from '../../../shared/EadSearch'

export default {

    data(){
        return {
            filter: ''
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
                page: this.courses.current_page,
            }
        },
    },
    methods:{
        loadCourses(page = 1){
            this.$store.dispatch('loadCourses', {...this.params, page})
        },

        search(filter){
            this.filter = filter
            this.loadCourses()
        },
    },
    components:{
        EadPagination,
        EadItem,
        EadSearch,
    }
}
</script>

<style scoped>

</style>
