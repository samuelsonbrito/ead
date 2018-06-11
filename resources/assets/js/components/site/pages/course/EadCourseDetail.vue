<template>

<div>
    <h1>{{ course.name }}</h1>

        <div v-if="course.image">
            <img :src="[`/storage/courses/${course.image}`]" class="image-preview" :alt="course.name">
        </div>
            
        <div v-else>
            <img :src="[`/image/no-image.png`]" class="image-preview" :alt="course.name">
        </div> 

</div>

</template>

<script>
export default {
    props: ['id'],

    created(){
        this.loadCourse()
    },

    data(){
        return {
            course: {}
        }
    },

    methods: {
        loadCourse(){
            this.$store.dispatch('loadCourse', this.id)
                .then(response => this.course = response)
        }
    }
}
</script>

<style scoped>
.image-preview{
  max-width: 100px;
}
</style>
