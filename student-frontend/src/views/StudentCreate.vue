<template>
  <div class="max-w-lg mx-auto">
    <div class="bg-white rounded-xl shadow p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Add Student</h2>
      <StudentForm
        submit-label="Save Student"
        :error="error"
        @submit="handleSubmit"
      />
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from '../axios'
import StudentForm from '../components/StudentForm.vue'

const router = useRouter()
const error = ref('')

const handleSubmit = async (formData) => {
  try {
    await axios.post('/students', formData)
    router.push('/')
  } catch (err) {
    error.value = err.response?.data?.message || 'Something went wrong.'
  }
}
</script>