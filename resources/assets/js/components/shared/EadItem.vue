<template>
    <div class="col-3">
        
        <div v-if="item.image">
            <img :src="[`/storage/${path}/${item.image}`]" class="image-preview" :alt="item.name">
        </div>
        
        <div v-else>
            <img :src="[`/image/no-image.png`]" class="image-preview" :alt="item.name">
        </div>
        
        {{item.name}}

    </div>
</template>

<script>
export default {
    props: ['item','path']
}
</script>

<style scoped>
.image-preview{
  max-width: 100px;
}
</style>
