<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

const props = defineProps({
    task: {
        type: Object,
    },
});

const badges = {
    "at_work": '<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">В работе</span>',
    "success": '<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Выполнено</span>',
    "active": '<span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Активно</span>',
    "overdue": '<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-green-300">Время вышло</span>',
    "wait": '<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-green-300">Ожидание</span>',
}

</script>

<template>
    <Head title="Задача" />

    <AuthenticatedLayout>
        <div class="max-w m-5 p-6 bg-white border border-gray-200 rounded-lg shadow">
            <h5 class="mb-2 text-2xl font-bold tracking-tight">{{task.title}}</h5>
            <p class="font-normal">Описание: {{ task.body }}</p>
            <p v-if="user_getter_name" class="font-normal">Выполняюший пользователь: {{ task.user_getter.name }}</p>
            <p>Время начала: {{ task.period_start }}</p>
            <p>Время завершения: {{ task.period_end }}</p>
            <p >Статус: <span v-html="badges[task.status]"></span></p>
        </div>
    </AuthenticatedLayout>

</template>

<style lang="scss" scoped>

</style>