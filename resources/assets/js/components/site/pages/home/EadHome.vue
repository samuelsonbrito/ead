<template>
    <div>
        <h1>Cursos</h1>
        <div class="row">
            <div class="col-3" v-for="course in courses.data" :key="course.id">
                <div v-if="course.image">
                    <img :src="[`/storage/courses/${course.image}`]" class="image-preview" alt="">
                </div>
                <div v-else>
                    <img :src="[`/image/no-image.png`]" class="image-preview" alt="">
                </div>
                {{course.name}}
            </div>
            <hr>
        </div>

        <div class="row">
            <EadPagination :pagination="courses" @paginate="loadCourses"></EadPagination>
        </div>
    </div>
</template>

<script>
import EadPagination from '../../../shared/EadPagination'

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
    }
}
</script>

<style scoped>
.image-preview{
  max-width: 100px;
}
</style>
