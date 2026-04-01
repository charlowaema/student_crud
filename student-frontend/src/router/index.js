import { createRouter, createWebHistory } from 'vue-router'
import StudentList from '../views/StudentList.vue'
import StudentCreate from '../views/StudentCreate.vue'
import StudentEdit from '../views/StudentEdit.vue'

const routes = [
  { path: '/', component: StudentList },
  { path: '/create', component: StudentCreate },
  { path: '/edit/:id', component: StudentEdit },
]

export default createRouter({
  history: createWebHistory(),
  routes
})