<template>
    <div>
        <ul class="nav">
            <li class="nav-item">
                <router-link :to="{name: 'home'}" class="nav-link">Home</router-link>
            </li>

            <li class="nav-item">
                <router-link :to="{name: 'contact'}" class="nav-link">Contato</router-link>
            </li>

            <li class="nav-item" v-if="user.name">
                <router-link :to="{name: 'login'}" class="nav-link">
                    Usuário: {{ user.name }}
                </router-link>
            </li>

            <li class="nav-item" v-else>
                <router-link :to="{name: 'login'}" class="nav-link">Login</router-link>
            </li>
        </ul>
    </div>
</template>

<script>

export default {
    computed:{
        user(){
            return this.$store.state.auth.user
        }
    }  
}

</script>