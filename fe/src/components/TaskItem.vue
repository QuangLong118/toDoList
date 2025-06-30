<template>
  <!-- Form dạng fixed, căn giữa -->
  <div 
    v-if="showUpdateForm"
    class="fixed w-screen h-screen top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 right-0 bottom-0 bg-[rgba(0,0,0,0.5)] z-40"
    @click="toggleUpdateForm"
  ></div>

  <div 
    v-if="showDeleteConfirm"
    class="fixed w-screen h-screen top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 right-0 bottom-0 bg-[rgba(0,0,0,0.5)] z-40"
    @click="toggleDeleteConfirm"
  ></div>
  
  <div 
    v-if="showUpdateForm"
    class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 bg-white p-6 rounded shadow-lg z-1000"
  >
    <UpdateForm :task="task" />
  </div>

  <div 
    v-if="showDeleteConfirm"
    class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 bg-white p-6 rounded shadow-lg z-1000"
  >
    <DeleteConfirm :task="task" :onClose="toggleDeleteConfirm"/>
  </div>





  <div :id="task.uuid" class="items-center">
    <div class="grid grid-cols-12 ">
      <div 
        class="col-span-1 border-1 border-black flex items-center justify-center"
      >
        {{ stt===0 ? 'STT' : stt  }}
      </div>
      <div 
        class="col-span-5 border-1 border-black flex items-center justify-center"
      >
        {{ task.name ?? "Name" }}
      </div>
      <div 
        class="col-span-2 border-1 border-black flex items-center justify-center"
      >
        {{  task.deadline ? task.deadline.substring(0, 10) : 'Deadline' }}
      </div>
      <div 
        class="col-span-1 border-1 border-black flex items-center justify-center"
      >
        <!-- {{ task.completed ?? 'Completed'  }} -->
        {{ task.completed === 0  ? 'Undone' : (task.completed === 1 ? 'Done' : "Status")  }}
      </div>
      <div class="col-span-1 border-1 border-black text-center">
        <button 
          v-if="task.name" 
          @click="toggleDetail"
          class="my-[4px] cursor-pointer"
        >
          Detail
        </button>
      </div>
      <div class="col-span-1 border-1 border-black text-center">
        <button 
          v-if="task.name" 
          @click="toggleUpdateForm"
          class="my-[4px] cursor-pointer"
        >
          Update
        </button>
      </div>
      <div class="col-span-1 border-1 border-black text-center">
        <button 
          v-if="task.name" 
          @click="toggleDeleteConfirm"
          class="my-[4px] cursor-pointer"
        >
          Delete
        </button>
      </div>
    </div>
  </div>

  <div v-if="showDetail">
    <div class="grid grid-cols-12">
      <div class="col-span-3">Name</div>
      <div class="col-span-9">{{ task.name }}</div>
    </div>
    <div class="grid grid-cols-12">
      <div class="col-span-3">Description</div>
      <div class="col-span-9">{{ task.description }}</div>
    </div>
    <div class="grid grid-cols-12">
      <div class="col-span-3">Deadline</div>
      <div class="col-span-9">{{  task.deadline.substring(0, 10)  }}</div>
    </div>
    <div class="grid grid-cols-12">
      <div class="col-span-3">Status</div>
      <div class="col-span-9">{{ task.completed === 0  ? 'Undone' : 'Done'  }}</div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref} from 'vue'
import UpdateForm from './forms/updateForm.vue'
import DeleteConfirm from './forms/deleteConfirm.vue'

export default defineComponent({
  name: 'TaskItem',
  components: {
    UpdateForm,
    DeleteConfirm
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    stt: {
      type: Number,
      required: true
    },
    UpdateTask: {
      type: Function,
      required: false,
    }
  },
  setup() {
    const showDetail = ref(false)
    const showUpdateForm = ref(false)
    const showDeleteConfirm = ref(false)

  

    
    const toggleDetail = () => {
      showDetail.value = !showDetail.value
    }

    const toggleUpdateForm = () => {
      showUpdateForm.value = !showUpdateForm.value
    }
    const toggleDeleteConfirm = () => {
      showDeleteConfirm.value = !showDeleteConfirm.value
    }

    return {
      showDetail,
      showUpdateForm,
      showDeleteConfirm,
      toggleDetail,
      toggleUpdateForm,
      toggleDeleteConfirm
    }
  }
})
</script>
