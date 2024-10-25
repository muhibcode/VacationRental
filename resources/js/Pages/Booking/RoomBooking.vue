<template>
    <form @submit.prevent="submit">
        <div class="ml-10 w-48">
            <div>
                <InputLabel for="name" value="Name" />

                <input
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autofocus
                />

                <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
            </div>
            <div class="mt-5">
                <InputLabel for="city" value="City" />

                <input
                    id="city"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.city"
                />
                <!-- <h4>{{ form.errors.city }}</h4> -->
                <!-- <InputError class="mt-2" :message="form.errors.country" /> -->
            </div>
            <div class="mt-5">
                <InputLabel for="address" value="Address" />

                <input
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                />

                <!-- <InputError class="mt-2" :message="form.errors.beds" /> -->
            </div>
            <div class="mt-5">
                <InputLabel for="tariff" value="Charges/Rate" />

                <input
                    id="tariff"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.tariff"
                />

                <!-- <InputError class="mt-2" :message="form.errors.baths" /> -->
            </div>
        </div>

        <PrimaryButton
            class="mt-10 ml-10 ms-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
        >
            Reserve
        </PrimaryButton>
    </form>
</template>
<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { reactive } from "vue";
import axios from "axios";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    city: "",
    address: "",
    tariff: "",
});

const submit = () => {
    // localStorage.setItem()

    form.post(route("booking.store"));

    console.log(form);
};
// {date:
//     activity[]
// }
// defineProps({ listing: String })
</script>
