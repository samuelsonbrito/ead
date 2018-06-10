<template>
    
    <div>

        <EadSiteHeader></EadSiteHeader>

        <router-view></router-view>

        <EadSiteFooter></EadSiteFooter>

    </div>
</template>

<script>

import EadSiteHeader from './EadSiteHeader'
import EadSiteFooter from './EadSiteFooter'

export default {
    components: {
        EadSiteHeader,
        EadSiteFooter,
    }    
}
</script>

<style scoped>

</style>
