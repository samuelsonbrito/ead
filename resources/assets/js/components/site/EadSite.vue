<template>
    
    <div>

        <EadSiteHeader></EadSiteHeader>

        <div class="container">
            <router-view></router-view>
        </div>
        

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
