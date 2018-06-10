<template>
    <div>
        Sou a homepage
    </div>
</template>

<script>
export default {
    created(){
        if(this.courses.data.length == 0)
            this.$store.dispatch('loadCourses', {})
    },
    computed:{
        courses(){
            return this.$store.state.courses.items
        }
    }
}
</script>

<style scoped>

</style>
