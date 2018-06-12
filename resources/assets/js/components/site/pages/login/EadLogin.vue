<template>
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-sm-4">
                <div class="card">

                    <div class="card-header">
                        Login
                    </div>

                    <div class="card-body">
                        <form class="form" @submit.prevent="onSubmit">
                            <div class="form-group">
                                <input type="email" v-model="user.email" class="form-control" placeholder="E-mail">
                            </div>

                            <div class="form-group">
                                <input type="password" v-model="user.password" class="form-control" placeholder="Senha">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            

        </div>

    </div>
</template>

<script>
export default {
    
    data(){
        return {
            user:{
                email: '',
                password: '',
            }
        }
    },

    methods:{
        onSubmit(){
            this.$store.dispatch('login', this.user)
                .then(() => this.$router.push({name: 'admin.dashboard'}))
        },
    }
}
</script>

<style scoped>

</style>
