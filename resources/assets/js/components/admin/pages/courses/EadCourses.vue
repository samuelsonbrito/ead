<template>
  <div>
      <h1>Listagem de Courses</h1>

      <table class="table table-dark">

        <thead>
          <tr>
            <th>#</th>
            <th>NOME</th>
            <th>AÇÕES</th>
          </tr>

        </thead>

        <tbody>

          <tr v-for="(course, index) in courses.data" :key="index">
            <td>{{ course.id }}</td>
            <td>{{ course.name }}</td>
            <td>Ação</td>
          </tr>

        </tbody>

      </table>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  created(){
    this.loadCourses();
  },
  data(){
    return {
      courses: {
        data: []
      }
    }
  },
  methods: {
    loadCourses(){
      axios.get('/api/v1/courses')
        .then(response => {
          this.courses = response
        })
        .catch(e => console.log(e))
    }
  }
}
</script>

<style scoped>

</style>
