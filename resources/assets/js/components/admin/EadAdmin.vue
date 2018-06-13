<template>
    <div>
        <nav class="navbar navbar-expand navbar-dark bg-dark">
            <div class="container">

                <ul class="navbar-nav">

                    <router-link :to="{ name: 'admin.dashboard'}" class="navbar-brand">EAD</router-link>

                    <li class="nav-item">
                        <router-link :to="{ name: 'admin.categories'}" class="nav-link">Categorias</router-link>
                    </li>

                    <li class="nav-item">
                        <router-link :to="{ name: 'admin.courses'}" class="nav-link">Cursos</router-link>
                    </li>

                    <li class="nav-item">
                       <a href="#" class="nav-link">
                            {{ user.name }} (<a href="#" @click.prevent="logoff">Sair</a>)
                       </a>
                        
                    </li>

                </ul>

                <div class="form-inline mt-2 mt-md-0">
                    <button class="btn btn-default">Meu perfil</button>
                </div>
            </div>
        </nav>

        <div class="container">
            <router-view></router-view>
        </div>

    </div>

</template>

<script>

export default {
    computed:{
        user(){
            return this.$store.state.auth.user
        },
    },
    
    methods:{
        logoff(){
            this.$store.dispatch('logoff')
            this.$router.push({ name: 'login' })
        }
    }
}

</script>

<style scoped>

</style>
