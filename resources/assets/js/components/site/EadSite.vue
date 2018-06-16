<template>
    
    <div>

        <ead-site-header></ead-site-header>

        <div>
            <router-view></router-view>
        </div>
        

        <ead-site-footer></ead-site-footer>

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
