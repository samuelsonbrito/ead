<template>
	<ul class="md-ui component-pagination">
	    <li v-if="pagination.current_page > 1" class="pagination-arrow arrow-left" @click.prevent="changePage(pagination.current_page - 1)">
           <i class="material-icons">keyboard_arrow_left</i>
	    </li>

	    <li v-if="pagination.last_page > 1" v-for="(page, index) in pagesNumber" :class="['pagination-number', {'current-number': page == pagination.current_page}]" :key="index" @click.prevent="changePage(page)">
          {{ page }}
      </li>

	    <li v-if="pagination.current_page < pagination.last_page" class="pagination-arrow arrow-right" @click.prevent="changePage(pagination.current_page + 1)">
          <i class="material-icons">keyboard_arrow_right</i>
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

<style scoped lang="scss">

.md-ui.component-pagination {
	list-style: none;
	padding: 8px;
	li {
		border-radius: 50%;
		color: rgba(33,33,33 ,1);
		display: inline-block;
		margin: 0;
		transition: .15s ease-in;
		cursor: pointer;
		&:hover {
			background: rgba(30, 186, 233, 0.12);
		}
	}
	.pagination-number,
	.pagination-arrow i {
		vertical-align: middle;
	}
	.pagination-number {
		font-family: "Roboto", sans-serif;
		font-size: 14px;
		text-align: center;
		line-height: 24px;
		min-width: 40px;
		padding: 8px 0;
		&.current-number {
			background: #536DFE;
			color: #fff;
		}
	}
	.pagination-arrow i {
		font-size: 24px;
		padding: 8px;
	}
}
</style>