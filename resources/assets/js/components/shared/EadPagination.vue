<template>
	<ul class="pagination">
	    <li v-if="pagination.current_page > 1">
        <a href="#" class="page-link" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
           <span aria-hidden="true">«</span>
        </a>
	    </li>

	    <li v-if="pagination.last_page > 1" v-for="(page, index) in pagesNumber" :class="['page-item', {'active': page == pagination.current_page}]" :key="index">
        <a href="#" class="page-link" @click.prevent="changePage(page)">
          {{ page }}
        </a>
      </li>

	    <li v-if="pagination.current_page < pagination.last_page">
	      <a href="#" class="page-link" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
          <span aria-hidden="true">»</span>
        </a>
	    </li>
    </ul>
</template>


<script>
  export default{
      props: {
        pagination: {
          type: Object,
          required: true
        },
        offset: {
          type: Number,
          default: 4
        }
    },
    computed: {
      pagesNumber() {
        
        if (!this.pagination.to) {
          return [];
        }
        
        let from = this.pagination.current_page - this.offset
        
        from = (from < 1) ? 1 : from
        
        let to = from + this.offset
        
        to = (to >= this.pagination.last_page) ? this.pagination.last_page : to
        
        let pagesArray = [];

        for (let page = from; page <= to; page++) {
          pagesArray.push(page)
        }
        
        return pagesArray
      }
    },
    methods : {
      changePage(page) {
        this.$emit('paginate', page)
      }
    }
  }
</script>

<style scoped>
</style>