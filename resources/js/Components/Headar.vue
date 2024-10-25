<template>
    <header>
        <div class="grid grid-cols-3 bg-slate-50 h-20 py-3">
            <h1 class="flex items-center font-medium text-lg pl-6">
                Logo Here
            </h1>
            <!-- <div
                    class="items-center rounded-full hover:bg-gray-200 py-2.5 px-5 h-12 w-32"
                >
                    <button class="text-sm font-medium">Destination</button>
                </div> -->
            <div class="flex items-center justify-evenly">
                <input
                    type="text"
                    class="h-9 bg-white border border-gray-300 w-44"
                    placeholder="Search City"
                />
                <div class="w-64">
                    <VueDatePicker
                        placeholder="       Check In | Check Out"
                        v-model="date"
                        @range-start="onRangeStart"
                        @range-end="onRangeEnd"
                        :enableTimePicker="false"
                        range
                        multi-calendars
                    />
                </div>
            </div>

            <div class="flex items-center justify-start">
                <details class="dropdown dropdown-bottom dropdown-end">
                    <summary tabindex="0" role="button" class="btn m-1">
                        Add Guest:
                        {{ form.noOfAdults + form.noOfChildren }}
                    </summary>
                    <ul
                        tabindex="0"
                        class="dropdown-content menu bg-base-100 rounded-box z-[1] w-80 p-2 mt-2 mr-1 shadow"
                    >
                        <div class="grid grid-cols-2 pl-4 pt-4">
                            <h2 class="flex items-center">Adults</h2>
                            <div class="flex justify-evenly items-center">
                                <button
                                    :disabled="form.noOfAdults < 1"
                                    class="material-symbols-outlined shadow-md btn active:shadow-none w-0 rounded-full"
                                    @click="() => (form.noOfAdults -= 1)"
                                >
                                    remove
                                </button>
                                <h2>{{ form.noOfAdults }}</h2>

                                <button
                                    class="material-symbols-outlined shadow-md btn active:shadow-none w-0 rounded-full"
                                    @click="() => (form.noOfAdults += 1)"
                                >
                                    add
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 pl-4 mt-8">
                            <h2 class="flex items-center">Children</h2>
                            <div class="flex justify-evenly items-center">
                                <button
                                    :disabled="form.noOfChildren < 1"
                                    class="material-symbols-outlined btn shadow-md active:shadow-none w-0 rounded-full"
                                    @click="() => (form.noOfChildren -= 1)"
                                >
                                    remove
                                </button>
                                <h2>{{ form.noOfChildren ?? 0 }}</h2>

                                <button
                                    class="material-symbols-outlined btn shadow-md active:shadow-none w-0 rounded-full"
                                    @click="() => (form.noOfChildren += 1)"
                                >
                                    add
                                </button>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 pl-4 mt-8 mb-4">
                            <h2 class="flex items-center">Total Guests</h2>
                            <div
                                class="flex justify-evenly items-center text-sm font-semibold"
                            >
                                <h1>
                                    {{ form.noOfAdults + form.noOfChildren }}
                                </h1>
                                <!-- <button
                                    :disabled="noOfChildren < 1"
                                    class="material-symbols-outlined btn shadow-md active:shadow-none w-0 rounded-full"
                                    @click="() => (noOfChildren -= 1)"
                                >
                                    remove
                                </button>
                                <h2>{{ noOfChildren }}</h2>

                                <button
                                    class="material-symbols-outlined btn shadow-md active:shadow-none w-0 rounded-full"
                                    @click="() => (noOfChildren += 1)"
                                >
                                    add
                                </button> -->
                            </div>
                        </div>
                    </ul>
                </details>

                <Button
                    class="btn bg-yellow-400 hover:bg-yellow-500"
                    @click.prevent="searchRental"
                >
                    Search</Button
                >
                <div class="flex items-center">
                    <Button type="reset" class="btn" @click="clearFilter">
                        Clear</Button
                    >
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

import { Link, useForm } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";
import { gCheckIn, gCheckOut } from "@/Composables/Guest";

const props = defineProps({
    filters: Object,
});
const dialog = ref(false);
const filter = ref(false);
const date = ref();

// let noOfChildren = ref(0);
// let noOfAdults = ref(0);

// onMounted(() => {
//     // form.get(route("rental.index"));
// });
const form = useForm({
    checkin_date: "",
    checkout_date: "",
    noOfChildren: props.filters.noOfChildren
        ? Number(props.filters.noOfChildren)
        : 0,
    noOfAdults: props.filters.noOfAdults ? Number(props.filters.noOfAdults) : 0,
    maxGuest: props.filters.maxGuest ? Number(props.filters.maxGuest) : 0,
    noOfBedrooms: Number(props.filters.noOfBedrooms ?? 0),
    noOfBeds: Number(props.filters.noOfBeds ?? 0),
    noOfBaths: Number(props.filters.noOfBaths ?? 0),
    filterCount: Number(props.filters.filterCount ?? 0),
    minPrice: Number(props.filters.minPrice ?? 10),
    maxPrice: Number(props.filters.maxPrice ?? 500),
});

date.value = [
    props.filters.checkin_date ?? "",
    props.filters.checkout_date ?? "",
];
const onRangeStart = (value) => {
    form.checkin_date = value.toLocaleDateString();

    //   alert(`Selected date in range is: ${value}`);
};
const onRangeEnd = (value) => {
    form.checkout_date = value.toLocaleDateString();
    //   alert(`Selected date in range is: ${value}`);
};
const clearFilter = () => {
    date.value = [];
    form.checkin_date = "";
    form.checkout_date = "";
    form.maxGuest = 0;
    form.noOfAdults = 0;
    form.noOfChildren = 0;
    searchRental();
};

const searchRental = () => {
    form.maxGuest = form.noOfAdults + form.noOfChildren;
    form.get(route("rental.index"), {
        preserveScroll: true,
    });
};
</script>
