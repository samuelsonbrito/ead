<template>
    <div>
        <ul>
            <li>
                <router-link :to="{ name: 'admin.dashboard'}">Dashboard</router-link>
                <router-link :to="{ name: 'admin.courses'}">Cursos</router-link>
            </li>
        </ul>

        <router-view></router-view>
    </div>

</template>

<script>
export default {
  
}
</script>

<style scoped>

</style>
