<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    task: {
        type: Object,
    },
});

const form = useForm({
});

const submit = () => {
    form.post(route('task', props.task.id));
};
</script>

<template>
    <Head title="Задача" />

    <AuthenticatedLayout>
        <div class="flex items-center flex-col">
            <div class="p-6 m-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <h5 class="mb-2 text-2xl font-bold tracking-tight">{{task.title}}</h5>
                <p class="font-normal">Имя создателя: {{task.user_creator.name}}</p>
                <p class="font-normal">Описание: {{ task.body }}</p>
                <p>Время начала: {{ task.period_start }}</p>
                <p>Время завершения: {{ task.period_end }}</p>
                <form @submit.prevent="submit">
                    <button type="submit" href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Взять задачу
                    </button>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>

</template>

<style lang="scss" scoped>

</style>