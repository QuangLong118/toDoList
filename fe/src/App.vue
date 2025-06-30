<template>
  <!-- Lớp phủ mờ -->
  <div 
    v-if="showForm"
    class="fixed w-screen h-screen top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 right-0 bottom-0 bg-[rgba(0,0,0,0.5)] z-40"
    @click="toggleForm"
  ></div>

  <div class="mx-[230px]">

    <!-- Nút toggle -->
    <button 
      @click="toggleForm"
      class="mt-4 mb-4 px-4 py-2 bg-blue-500 text-white rounded cursor-pointer"
    >
      Create Task
    </button>

    <!-- Form dạng fixed, căn giữa -->
    <div 
      v-if="showForm"
      class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 z-50 bg-white p-6 rounded shadow-lg z-100"
    >
      <CreateForm />

    </div>

    <TaskList />
  </div>
</template>

<script>
import TaskList from './components/TaskList.vue';
import CreateForm from './components/forms/createForm.vue';
export default {
  name: 'App',
  components: {
    TaskList,
    CreateForm,
  },
  data() {
    return {
      showForm: false,
      updateForm: false
    };

  },
  methods: {
    toggleForm() {
      this.showForm = !this.showForm;
    }

  }
};
</script>
