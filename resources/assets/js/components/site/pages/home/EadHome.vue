<template>
    <div>
        <h1>Cursos</h1>
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

export default {
    created(){
        if(this.courses.data.length == 0)
            this.$store.dispatch('loadCourses', {})
    },
    computed:{
        courses(){
            return this.$store.state.courses.items
        }
    },
    methods:{
        loadCourses(page = 1){
            this.$store.dispatch('loadCourses', {page: page})
        }
    },
    components:{
        EadPagination,
        EadItem,
    }
}
</script>

<style scoped>

</style>
