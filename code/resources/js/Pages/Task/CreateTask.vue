<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const {task, routeName} = defineProps({
    task: {
        type: Object,
    },
    routeName: {
        type: String
    }
});

const form = useForm({
    title: task?.title ?? "",
    body: task?.body ?? "",
    period_start: task?.period_start,
    period_end: task?.period_end,
});

const submit = () => {
    form.period_end = `${form.period_end}`
    form.period_start = `${form.period_start}`
    form.post(route(routeName ?? 'createTask', task?.id));
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Создать задачу" />
        <form class="max-w-xl mx-auto" @submit.prevent="submit">
            <div>
                <InputLabel for="title" value="Заголовок" />

                <TextInput
                    id="title"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="body" value="Описание" />

                <TextInput
                    id="body"
                    class="mt-1 block w-full"
                    v-model="form.body"
                    required
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="mt-4">
                <InputLabel for="title" value="Дата начала" />

                <div class="relative">
                    <TextInput class="mt-1 block w-full" v-model="form.period_start" id="datepicker-autohide" type="datetime-local" placeholder="Вырать дату завершения" />
                </div>
                <InputError class="mt-2" :message="form.errors.period_start" />

            </div>
            <div class="mt-4">
                <InputLabel for="title" value="Дата завершения" />
                <div class="relative">
                    <TextInput class="mt-1 block w-full" v-model="form.period_end" id="datepicker-autohide" type="datetime-local" placeholder="Вырать дату завершения" />
                </div>
              
                <InputError class="mt-2" :message="form.errors.period_end" />

            </div>
            <div class="mt-4">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{routeName ? "Изменить" : "Создать"}}</button>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
