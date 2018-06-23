<template>

    <v-app>

   <v-navigation-drawer :clipped="$vuetify.breakpoint.lgAndUp" v-model="drawer" fixed
      app>
      <v-list class="pa-1">
        <v-list-tile avatar>
          <v-list-tile-avatar>
            <img src="/image/user.png" >
          </v-list-tile-avatar>
          <v-list-tile-content>
            <v-list-tile-title>{{ user.name }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
      <v-list class="pt-0" dense>
        <v-divider></v-divider>
        <v-list-tile v-for="item in items" :key="item.title" :to="item.url">
          <v-list-tile-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.title }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>

    <v-toolbar
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      color="blue darken-3"
      dark
      app
      fixed
    >
    <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
    <v-toolbar-title>EAD</v-toolbar-title>
    <v-spacer></v-spacer>

    <v-menu :nudge-width="100">
        <v-toolbar-items slot="activator">
          <v-btn flat>{{user.name}}</v-btn>
          <v-icon dark>arrow_drop_down</v-icon>
        </v-toolbar-items>
        <v-list>
          <v-list-tile @click.prevent="logoff">
            <v-list-tile-title >Sair</v-list-tile-title>
          </v-list-tile>
        </v-list>
      </v-menu>
    </v-toolbar>


    <v-content>
        <v-container fluid>
            <div class="container">
                <router-view></router-view>
            </div>
        </v-container>
    </v-content>

    </v-app>

</template>

<script>

export default {

    data(){
        return {
            drawer: null,
            items: [
            { title: 'Home', icon: 'dashboard', url: {name: 'campus.dashboard'} },
            { title: 'Meus Cursos', icon: 'loyalty', url: {name: 'campus.courses'} },
            { title: 'Comunidade', icon: 'shop', url: {name: 'admin.courses'} },
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
            this.$router.push({ name: 'login' })
        }
    },


}

</script>

<style scoped>

</style>