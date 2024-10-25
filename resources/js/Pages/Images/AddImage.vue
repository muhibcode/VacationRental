<template>
    <form enctype="multipart/form-data" @submit.prevent="submit">
        <h1>Add Multiple Images</h1>
        <input type="file" multiple name="images[]" @change="onImageChange" />
        <button type="submit" class="bg-yellow-500 text-center">Submit</button>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    rental: String,
});
const form = useForm({
    images: [],
    rental: props.rental,
});

console.log(props.rental);

const onImageChange = (e) => {
    form.images = e.target.files;
    // fd.append("images", e.target.files);
};

const submit = () => {
    console.log(form);

    form.post(route("image.store"));
};
</script>
