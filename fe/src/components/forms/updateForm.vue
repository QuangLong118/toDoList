<template>
  <div class="w-[500px] mx-auto">
    <div class="px-[50px] py-[36px] bg-[#ffffff]">
      <h1 class="text-center text-2xl font-bold my-[6px]">Update Task</h1>
      <form @submit.prevent="handleSubmit" class="space-y-4">
        <div class="my-[8px]">
          <label class="mb-[8px]">Name</label>
          <input
            v-model="form.name"
            type="text"
            placeholder="Enter name"
            class="mt-[4px] w-[376px] border border-gray-300 px-[12px] py-[8px] rounded-[8px]"
          />
        </div>

        <div class="my-[8px]">
          <label>Description</label>
          <textarea
            v-model="form.description"
            placeholder="Enter description"
            class="mt-[4px] w-[376px] h-[100px] border border-gray-300 px-[12px] py-[8px] rounded-[8px]"
          ></textarea>
        </div>

        <div class="my-[8px]">
          <label class="mb-[8px]">Deadline</label>
          <input
            v-model="form.deadline"
            type="date"
            class="mt-[4px] w-[376px] border border-gray-300 px-[12px] py-[8px] rounded-[8px] focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
          />
        </div>

        <div class="my-[8px]">
          <label class="mb-[8px]">Completed</label>
          <div class="mt-[4px] flex items-center">
            <input
              v-model="form.completed"
              type="checkbox"
              class="mr-2"
            />
            <span>Mark as completed</span>
          </div>
        </div>

        <button
          type="submit"
          class="mt-[12px] bg-[#60a5fa] px-[24px] py-[4px] rounded-[8px] text-[#ffffff] py-2 px-4 rounded hover:bg-[#3b82f6] transition-colors cursor-pointer"
        >
          Update
        </button>
      </form>

      <div v-if="submitted" class="mt-4 p-4 bg-green-100 text-green-700 rounded">
        <p>Task updated successfully!</p>
        <p><strong>Name:</strong> {{ form.name }}</p>
        <p><strong>Deadline:</strong> {{ form.deadline }}</p>
        <p><strong>Description:</strong> {{ form.description }}</p>
        <p><strong>Completed:</strong> {{ form.completed }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import { ref, watch} from 'vue'

export default {
  name: 'UpdateForm',
  props: {
    task: {
      type: Object,
      required: true,
    },
  },
  setup(props) {
    const API_URL = process.env.VUE_APP_BACKEND_SERVER

    const form = ref({
      name: '',
      description: '',
      deadline: '',
      completed: false,
    })

    const submitted = ref(false)

    watch(
      () => props.task,
      (newTask) => {
        if (newTask) {
          form.value.name = newTask.name || ''
          form.value.description = newTask.description || ''
          form.value.deadline = newTask.deadline ? newTask.deadline.substring(0, 10) : ''
          form.value.completed = Boolean(newTask.completed) || false
        }
      },
      { immediate: true }
    )

    const handleSubmit = async () => {
      try {
        const response = await fetch(`${API_URL}/tasks/${props.task.uuid}`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            name: form.value.name,
            deadline: form.value.deadline,
            completed: form.value.completed,
            description: form.value.description,
          }),
        })

        if (!response.ok) {
          throw new Error('Failed to update task')
        }

        const data = await response.json()
        console.log('API response:', data)

        alert('Task updated successfully!')
        window.location.reload()
      } catch (error) {
        console.error('Error:', error)
        alert('Failed to update task. Please try again.')
      }
    }

    return {
      form,
      submitted,
      handleSubmit,
    }
  },
}
</script>
