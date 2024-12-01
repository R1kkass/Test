<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    tasks: {
        type: Array,
    },
});
</script>

<template>
    <Head title="Актуальные задачи" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Актуальные задачи</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-5">
                    <Link v-for="task in tasks" :href="route('task', task.id)" class="block max-w p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight">{{task.title}}</h5>
                        <p class="font-normal">Имя создателя: {{task.user_creator.name}}</p>
                        <p class="font-normal">Описание: {{ task.body }}</p>
                        <p>Время начала: {{ task.period_start }}</p>
                        <p>Время завершения: {{ task.period_end }}</p>
                    </Link>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
