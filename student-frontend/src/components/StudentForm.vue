<template>
  <form @submit.prevent="submitForm" class="space-y-5">
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
      <input
        v-model="localForm.name"
        type="text"
        placeholder="Enter name"
        required
        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
      <input
        v-model="localForm.email"
        type="email"
        placeholder="Enter email"
        required
        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
    </div>
    <div>
      <label class="block text-sm font-medium text-gray-700 mb-1">Course</label>
      <input
        v-model="localForm.course"
        type="text"
        placeholder="Enter course"
        required
        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400"
      />
    </div>

    <p v-if="error" class="text-red-500 text-sm">{{ error }}</p>

    <div class="flex gap-3 pt-2">
      <button
        type="submit"
        class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition"
      >
        {{ submitLabel }}
      </button>
      <RouterLink to="/">
        <button
          type="button"
          class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-medium transition"
        >
          Back
        </button>
      </RouterLink>
    </div>
  </form>
</template>

<script setup>
import { ref, watch } from 'vue'
import { RouterLink } from 'vue-router'

const props = defineProps({
  initialForm: {
    type: Object,
    default: () => ({ name: '', email: '', course: '' })
  },
  error: { type: String, default: '' },
  submitLabel: { type: String, default: 'Save' }
})

const emit = defineEmits(['submit'])
const localForm = ref({ ...props.initialForm })

watch(() => props.initialForm, (val) => {
  localForm.value = { ...val }
})

const submitForm = () => {
  emit('submit', localForm.value)
}
</script>