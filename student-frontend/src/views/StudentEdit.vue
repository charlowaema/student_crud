<template>
  <div class="max-w-lg mx-auto">
    <div class="bg-white rounded-xl shadow p-6">
      <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Student</h2>
      <StudentForm
        submit-label="Update Student"
        :initial-form="form"
        :error="error"
        @submit="handleSubmit"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import axios from '../axios'
import StudentForm from '../components/StudentForm.vue'

const router = useRouter()
const route = useRoute()
const error = ref('')
const form = ref({ name: '', email: '', course: '' })

onMounted(async () => {
  const res = await axios.get(`/students/${route.params.id}`)
  form.value = res.data
})

const handleSubmit = async (formData) => {
  try {
    await axios.put(`/students/${route.params.id}`, formData)
    router.push('/')
  } catch (err) {
    error.value = err.response?.data?.message || 'Something went wrong.'
  }
}
</script>