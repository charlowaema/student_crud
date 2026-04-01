<template>
  <div class="max-w-5xl mx-auto">
    <div class="bg-white rounded-xl shadow p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Students List</h2>

      <!-- Top Bar -->
      <div class="flex flex-col sm:flex-row justify-between items-center gap-4 mb-6">
        <RouterLink to="/create">
          <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition">
            + Add Student
          </button>
        </RouterLink>
        <input
          v-model="search"
          type="text"
          placeholder="Search by name, email or course..."
          class="w-full sm:w-80 border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
          @input="fetchStudents(1)"
        />
      </div>

      <!-- Table -->
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
          <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
            <tr>
              <th class="px-4 py-3">ID</th>
              <th class="px-4 py-3">Name</th>
              <th class="px-4 py-3">Email</th>
              <th class="px-4 py-3">Course</th>
              <th class="px-4 py-3">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="student in students"
              :key="student.id"
              class="border-t hover:bg-gray-50 transition"
            >
              <td class="px-4 py-3 text-gray-500">{{ student.id }}</td>
              <td class="px-4 py-3 font-medium text-gray-800">{{ student.name }}</td>
              <td class="px-4 py-3 text-gray-600">{{ student.email }}</td>
              <td class="px-4 py-3">
                <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs font-medium">
                  {{ student.course }}
                </span>
              </td>
              <td class="px-4 py-3 flex gap-2">
                <RouterLink :to="`/edit/${student.id}`">
                  <button class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs transition">
                    Edit
                  </button>
                </RouterLink>
                <button
                  @click="deleteStudent(student.id)"
                  class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs transition"
                >
                  Delete
                </button>
              </td>
            </tr>
            <tr v-if="students.length === 0">
              <td colspan="5" class="text-center py-8 text-gray-400">No students found.</td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="flex flex-wrap items-center gap-2 mt-6">
        <button
          @click="fetchStudents(currentPage - 1)"
          :disabled="currentPage === 1"
          class="px-3 py-1 border rounded-lg text-sm disabled:opacity-40 hover:bg-gray-100 transition"
        >
          ← Prev
        </button>
        <button
          v-for="page in totalPages"
          :key="page"
          @click="fetchStudents(page)"
          :class="['px-3 py-1 border rounded-lg text-sm transition', page === currentPage ? 'bg-blue-500 text-white border-blue-500' : 'hover:bg-gray-100']"
        >
          {{ page }}
        </button>
        <button
          @click="fetchStudents(currentPage + 1)"
          :disabled="currentPage === totalPages"
          class="px-3 py-1 border rounded-lg text-sm disabled:opacity-40 hover:bg-gray-100 transition"
        >
          Next →
        </button>
        <span class="ml-2 text-xs text-gray-500">
          Page {{ currentPage }} of {{ totalPages }} ({{ totalStudents }} students)
        </span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { RouterLink } from 'vue-router'
import axios from '../axios'

const students = ref([])
const search = ref('')
const currentPage = ref(1)
const totalPages = ref(1)
const totalStudents = ref(0)
const perPage = 5

const fetchStudents = async (page = 1) => {
  currentPage.value = page
  const res = await axios.get('/students', {
    params: { page, per_page: perPage, search: search.value }
  })
  students.value = res.data.data
  totalPages.value = res.data.last_page
  totalStudents.value = res.data.total
}

const deleteStudent = async (id) => {
  if (confirm('Are you sure you want to delete this student?')) {
    await axios.delete(`/students/${id}`)
    fetchStudents(currentPage.value)
  }
}

onMounted(() => fetchStudents(1))
</script>