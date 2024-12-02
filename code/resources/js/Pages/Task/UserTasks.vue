<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    getted_tasks: {
        type: Array,
    },
    success_tasks: {
        type: Array,
    },
    created_tasks: {
        type: Array,
    },
});

const showTasks = ref(false) 
const showSuccessTasks = ref(false) 
const showCreatedTasks = ref(false) 

const form = useForm({}) 

const successStatus = (task) => {
    form.post(route("updateStatus", task.id))
}

const rejectTask = (task) => {
    form.post(route("rejectTask", task.id))
}

const setShowTasks = () => {
    showTasks.value = !showTasks.value
    console.log(showTasks.value);
     
}

</script>

<template>
    <Head title="Мои задачи" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Мои задачи</h2>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <button @click="setShowTasks" type="button" class="flex bg-white items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl dark:focus:ring-gray-800 dark:border-gray-700 text-black hover:bg-gray-200 gap-3">
                    <span>Задачи в работе: {{ getted_tasks.length }}</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>

                  <div  v-if="showTasks" class="flex flex-col gap-5">
                        <div v-for="task in getted_tasks" class="block max-w p-6 bg-white border rounded-lg shadow ">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-black">{{task.title}}</h5>
                            <p class="font-normal">Описание: {{ task.body }}</p>
                            <p>Время начала: {{ task.period_start }}</p>
                            <p>Время завершения: {{ task.period_end }}</p>
                            <div class="flex gap-2">
                                <button href="#" @click="()=>rejectTask(task)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >Отказаться</button>
                                <button href="#" @click="()=>successStatus(task)" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Завершить</button>
                            </div>
                        </div>
                </div>

                <button @click="showSuccessTasks=!showSuccessTasks" type="button" class="flex bg-white items-center justify-between w-full p-5 font-medium rtl:text-right text-black border border-b-0 border-gray-200 dark:border-gray-700 hover:bg-gray-200 800 gap-3">
                    <span>Выполенные задачи: {{ success_tasks.length }}</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
                <div v-if="showSuccessTasks" class="flex flex-col gap-5">
                    <div v-for="task in success_tasks" class="block max-w p-6 bg-white border rounded-lg shadow ">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-black">{{task.title}}</h5>
                        <p class="font-normal text-black">Описание: {{ task.body }}</p>
                        <p class="text-black">Время начала: {{ task.period_start }}</p>
                        <p class="text-black">Время завершения: {{ task.period_end }}</p>
                    </div>
                </div>

                <button @click="showCreatedTasks=!showCreatedTasks" type="button" class="flex items-center bg-white justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 text-black hover:bg-gray-200 gap-3">
                    <span>Ваши созданные задачи: {{ created_tasks.length }}</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                    </svg>
                </button>
                <div v-if="showCreatedTasks" class="flex flex-col gap-5">
                    <div v-for="task in created_tasks" class="block max-w p-6 bg-white border rounded-lg shadow ">
                        <Link :href="route('userTask', task.id)"><h5 class="mb-2 text-2xl font-bold tracking-tight text-black">{{task.title}}</h5></Link>
                        <p class="font-normal text-black">Описание: {{ task.body }}</p>
                        <p class="text-black">Время начала: {{ task.period_start }}</p>
                        <p class="text-black">Время завершения: {{ task.period_end }}</p>
                        <p  class="text-black" v-if="task.user_id_getter !== null">Выполняющий пользователь: {{ task.user_getter.name }}</p>
                        <Link :href="route('updateTask', task.id)" v-if="task.user_id_getter === null" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Изменить</Link>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>

</template>

<style lang="scss" scoped>

</style>