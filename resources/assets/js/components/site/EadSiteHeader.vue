<template>
    <div>
        Header
    </div>
</template>

<script>

export default {

    data(){
        return {
            drawer: null,
            items: [
            { title: 'Home', icon: 'dashboard', url: '' },
            { title: 'About', icon: 'question_answer', url: '' }
        ]
        }
    },

    computed:{
        user(){
            return this.$store.state.auth.user
        },
    },
    
    methods:{
        logoff(){
            this.$store.dispatch('logoff')
        }
    },


}

</script>

<style scoped>
.image-preview{
  max-width: 29px;
}

.header{
    background-color: #24292e
}
</style>