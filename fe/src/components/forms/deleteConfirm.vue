<template>
    
    <div class="bg-[#ffffff] p-6 rounded shadow-md w-[400px] px-[24px] py-[24px]">
    <h2 class="text-lg font-bold mb-4">Confirm Delete</h2>
    <p class="mb-4">
        Are you sure you want to delete task:
        <span class="font-semibold">{{ task.name }}</span>?
    </p>
    <div class="flex justify-end space-x-[8px]">
        <button
        class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400"
        @click="close"
        >
        Cancel
        </button>
        <button
        class="px-4 py-2 rounded bg-red-500 text-white hover:bg-red-600"
        @click="handleDelete"
        >
        Delete
        </button>
    </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
  name: 'DeleteConfirm',
  props: {
    task: {
      type: Object,
      required: true,
    },
    onClose: {
      type: Function,
      required: true,
    },
  },
  setup(props) {
    const API_URL = process.env.VUE_APP_BACKEND_SERVER

    const handleDelete = async () => {
      try {
        const res = await fetch(`${API_URL}/tasks/${props.task.uuid}`, {
          method: 'DELETE',
        })
        if (!res.ok) throw new Error('Failed to delete task')

        alert('Task deleted successfully.')

        if (props.onDeleted) props.onDeleted(props.task)
        window.location.reload()
      } catch (error) {
        console.error(error)
        alert('Failed to delete task.')
      }
    }

    const close = () => {
      props.onClose()
    }

    return { handleDelete, close }
  },
})
</script>
