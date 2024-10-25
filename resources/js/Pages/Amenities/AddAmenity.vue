<template>
    <form @submit.prevent="submit">
        <div class="ml-10 w-48">
            <div class="mt-5">
                <InputLabel for="title" value="Title" />

                <input
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                />

                <!-- <InputError class="mt-2" :message="form.errors.baths" /> -->
            </div>
            <br />

            <button
                class="bg-violet-500 hover:bg-violet-700 text-white font-bold py-2 px-4 rounded"
            >
                Submit
            </button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    title: "",
});

const submit = () => {
    form.post(route("amenities.store"));
};
</script>
