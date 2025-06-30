<script>
import { defineComponent, ref, onMounted } from 'vue'
import axios from 'axios'
import TaskItem from './TaskItem.vue'

export default defineComponent({
  name: 'TaskList',
  components: {
    TaskItem
  },
  setup() {
    const tasks = ref([])
    const loading = ref(false)
    const error = ref('')

    const API_URL = process.env.VUE_APP_BACKEND_SERVER
    console.log('API_URL:', process.env.VUE_APP_BACKEND_SERVER)


    const fetchTasks = async () => {
      loading.value = true
      try {
        const response = await axios.get(`${API_URL}/tasks`)
        tasks.value = response.data
        console.log(tasks)
      } catch (err) {
        error.value = 'Lỗi tải dữ liệu!'
      } finally {
        loading.value = false
      }
    }

    onMounted(() => {
      fetchTasks()
    })

    return {
      tasks,
      loading,
      error
    }
  }
})
</script>

<template>
  <div>
    <h1 class="bg-blue-500 text-white p-4">Danh sách Task</h1>
    <TaskItem :task="{}" :stt="0"/>

    <div v-if="loading">Đang tải...</div>

    <div v-else>
      <div v-for="(task, index) in tasks" :key="task.id">
        <TaskItem
          :task="{
            uuid: String(task.uuid),
            name: task.name,
            description: task.description,
            deadline: task.deadline,
            completed: task.completed
          }"
          :stt="index + 1"
        />
      </div>
    </div>

    <p v-if="error">{{ error }}</p>
  </div>
</template>
