<template>
    <div>

    <b-navbar toggleable="md" type="dark" variant="dark" class="header">

    <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

    <b-container>

    <b-navbar-brand href="#">
        <b-img :src="`/image/logo.png`" fluid alt="Descompila" class="image-preview" />
    </b-navbar-brand>

    <b-collapse is-nav id="nav_collapse">

        <b-navbar-nav>
        <b-nav-item :to="{name: 'home'}">Início</b-nav-item>
        <b-nav-item :to="{name: 'contact'}">Contato</b-nav-item>
        </b-navbar-nav>

        <!-- Right aligned nav items -->
        <b-navbar-nav class="ml-auto">
        <!--
        <b-nav-form>
            <b-form-input size="sm" class="mr-sm-2" type="text" placeholder="Search"/>
            <b-button size="sm" class="my-2 my-sm-0" type="submit">Search</b-button>
        </b-nav-form>
        -->
        <b-nav-item-dropdown right v-if="user.name">
            <!-- Using button-content slot -->
            <template slot="button-content">
            <em> {{ user.name }} </em>
            </template>
            <b-dropdown-item href="#">Meu perfil</b-dropdown-item>
            <b-dropdown-item href="#" @click.prevent="logoff">Sair</b-dropdown-item>
        </b-nav-item-dropdown>

        <b-nav-item :to="{name: 'login'}" v-else>Login</b-nav-item>

        </b-navbar-nav>

    </b-collapse>
    
    </b-container>
    
    </b-navbar>

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
        }
    },


}

</script>

<style scoped>
.image-preview{
  max-width: 29px;
}

.header{
    background-color: #24292e !important;
}
</style>