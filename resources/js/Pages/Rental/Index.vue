<template>
    <div>
        <Headar :filters="filters" />
        <div class="flex justify-evenly mt-2">
            <div class="flex items-center border px-2 py-2">
                <span class="material-symbols-outlined"> filter_alt </span>

                <button>icons</button>
            </div>
            <div class="flex items-center border px-2 py-2">
                <span class="material-symbols-outlined"> filter_alt </span>

                <button>other icons</button>
            </div>
            <div
                class="flex items-center btn border"
                onclick="my_modal_1.showModal()"
            >
                <!-- <div class="flex items-center border px-2 py-2">
                    <span class="material-symbols-outlined"> filter_alt </span>

                    <button class="btn" @click.prevent="showModal">
                        Filter 0
                    </button>
                </div> -->
                <span class="material-symbols-outlined"> tune </span>
                <h3 class="font-bold">Filter: {{ form.filterCount }}</h3>
                <!-- <button onclick="my_modal_1.showModal()">Filter</button> -->
                <dialog id="my_modal_1" class="modal">
                    <div class="modal-box">
                        <h1 class="flex mt-2">Price/24hr</h1>
                        <div class="flex justify-center mt-2">
                            <VueSimpleRangeSlider
                                style="width: 400px"
                                :min="10"
                                :max="500"
                                v-model="priceRange"
                                :update="onPricechange()"
                            >
                                <template #prefix="{ value }">$</template>
                            </VueSimpleRangeSlider>
                        </div>
                        <span class="divider"></span>
                        <div class="grid grid-cols-2 mt-1 pr-10 items-center">
                            <h2>Bedrooms</h2>

                            <div class="flex justify-evenly items-center">
                                <button
                                    class="material-symbols-outlined shadow-md btn"
                                    @click.stop.prevent="bedroomDec"
                                >
                                    remove
                                </button>
                                <h2>{{ form.noOfBedrooms }}</h2>

                                <button
                                    class="material-symbols-outlined shadow-md btn"
                                    @click.stop.prevent="bedroomInc"
                                >
                                    add
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 pt-4 pr-10 items-center">
                            <h2 class="justify-start">Beds</h2>
                            <div class="flex justify-evenly items-center">
                                <button
                                    class="material-symbols-outlined shadow-md btn active:shadow-none"
                                    @click="bedDec"
                                >
                                    remove
                                </button>
                                <h2>{{ form.noOfBeds }}</h2>

                                <button
                                    class="material-symbols-outlined shadow-md btn active:shadow-none"
                                    @click="bedInc"
                                >
                                    add
                                </button>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 pt-4 pr-10 items-center">
                            <h2>Baths</h2>
                            <div class="flex justify-evenly items-center">
                                <button
                                    class="material-symbols-outlined shadow-md btn active:shadow-none"
                                    @click="bathDec"
                                >
                                    remove
                                </button>
                                <h2>{{ form.noOfBaths }}</h2>

                                <button
                                    class="material-symbols-outlined shadow-md btn active:shadow-none"
                                    @click="bathInc"
                                >
                                    add
                                </button>
                            </div>
                        </div>

                        <div class="modal-action">
                            <form
                                @submit.stop.prevent="searchRental"
                                method="dialog"
                            >
                                <button class="btn btn-warning">
                                    Show {{ newArr.length }} places
                                </button>
                            </form>
                        </div>
                    </div>
                </dialog>
            </div>
        </div>
        <div class="grid grid-cols-4 ml-8">
            <a
                v-for="(item, index) in props.rentals.data"
                :key="index"
                class="flex flex-col w-80 h-80"
                target="_blank"
                :href="`http://127.0.0.1:8000/rental/${
                    item.id
                }?q=${JSON.stringify(sendQuery)}`"
            >
                <img
                    class="h-60 rounded-lg"
                    :src="item.images[0]['src']"
                    alt=""
                />
                <div class="px-2 pt-2">
                    <div class="flex justify-between">
                        <div>
                            <h1>{{ item.city }}</h1>
                        </div>
                        <div class="flex pr-1">
                            <span class="material-symbols-outlined"
                                >star_rate</span
                            >
                            <h1>4.90</h1>
                        </div>
                    </div>

                    <h1>stay with {{ item.owner.user.name }}</h1>
                    <h1>${{ item.tariff }}/night</h1>
                </div>
            </a>
            <!-- <div class="flex flex-col border border-black w-80 h-60">
                <img src="" alt="" />
                <h1 class="pl-2">lahore</h1>
                <h1 class="pl-2">price</h1>
            </div>
            <div class="flex flex-col border border-black w-80 h-60">
                <img src="" alt="" />
                <h1>lahore</h1>
                <h1>price</h1>
            </div>
            <div class="flex flex-col border border-black w-80 h-60">
                <img src="" alt="" />
                <h1>lahore</h1>
                <h1>price</h1>
            </div> -->
        </div>
        <!-- <button class="btn" :onclick="searchRental">Search</button>
        <br />
        <br />
        <Link :href="route('userprofile.show', $page.props.auth.user.id)">
            My Profile
        </Link>

        <br /> -->

        <!-- <label for="language">How Many Guests:</label>
        <div class="conatiner w-auto h-auto bg-white">
            <h1>Total Guest: {{ noOfAdults + noOfChildren }}</h1>
            <div class="flex">
                <h1 class="m-3">Adults {{ noOfAdults }}</h1>
                <button :onclick="() => (noOfAdults += 1)">Inc</button>
                <button
                    class="bg-yellow-400 hover:bg-yellow-500 active:bg-yellow-600 disabled:bg-slate-400"
                    :disabled="noOfAdults < 1"
                    :onclick="() => (noOfAdults -= 1)"
                >
                    --Dec
                </button>
            </div>
            <div class="flex">
                <h1 class="m-3">Children {{ noOfChildren }}</h1>
                <button :onclick="() => (noOfChildren += 1)">Inc</button>
                <button
                    v-if="noOfChildren > 0"
                    :onclick="() => (noOfChildren -= 1)"
                >
                    --Dec
                </button>
            </div>
        </div> -->

        <!-- <label for="language">BedRooms/Baths:</label>
        <div class="conatiner w-auto h-auto bg-white">
            <div class="flex">
                <h1 class="m-3">Bedrooms {{ noOfAdults }}</h1>
                <button :onclick="() => (noOfAdults += 1)">Inc</button>
                <button
                    v-if="noOfAdults > 0"
                    :onclick="() => (noOfAdults -= 1)"
                >
                    --Dec
                </button>
            </div>
            <div class="flex">
                <h1 class="m-3">Beds {{ noOfChildren }}</h1>
                <button :onclick="() => (noOfChildren += 1)">Inc</button>
                <button
                    v-if="noOfChildren > 0"
                    :onclick="() => (noOfChildren -= 1)"
                >
                    --Dec
                </button>
            </div>
            <div class="flex">
                <h1 class="m-3">Baths {{ noOfChildren }}</h1>
                <button :onclick="() => (noOfChildren += 1)">Inc</button>
                <button
                    v-if="noOfChildren > 0"
                    :onclick="() => (noOfChildren -= 1)"
                >
                    --Dec
                </button>
            </div>
        </div> -->

        <Link :href="route('rental.create')">Add Rental</Link>
        <br />
        <br />
        <Link :href="route('amenities.create')">Add Amenity</Link>
        <br />
        <br />

        <!-- <h1>{{ props.tapi }}</h1> -->
        <!-- <div v-for="(item, index) in rentals.data" :key="index">
            <Link :href="route('rental.show', item.id)">
                <h1>
                    {{ item.name }}
                    ${{ item.tariff }}/24hrs
                </h1>
                <div v-if="!item.is_booked">
                    <h1>Available</h1>
                </div>
                <h1 v-else>Dates</h1>
            </Link>
        </div> -->
    </div>
</template>

<script setup>
import { Link, useForm } from "@inertiajs/vue3";
import "@vuepic/vue-datepicker/dist/main.css";
import VueSimpleRangeSlider from "vue-simple-range-slider";
import "vue-simple-range-slider/css";
import Headar from "@/Components/Headar.vue";

import { ref, onMounted } from "vue";
import axios from "axios";

const props = defineProps({
    rentals: Object,
    filters: Object,
    allrentals: Array,
    // tapi: String,
});
// console.log(props.tapi);

// const fetc = ref("");
// fetc.value = axios.get("http://localhost:3000/", {
//     withCredentials: true,
//     withXSRFToken: true,
// });

// onMounted(() => {
//     const data = form.get("http://localhost:3000/");

//     console.log(data);
// });

let newArr = ref([]);
// const newTab = ref(true);

// const openInNewTab = (href) => {
//     Object.assign(document.createElement("a"), {
//         target: "_blank",
//         rel: "noopener noreferrer",
//         href: href,
//     }).click();
// };

const sendQuery = {
    checkin_date: props.filters.checkin_date ?? "",
    checkout_date: props.filters.checkout_date ?? "",
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
};
const form = useForm({
    checkin_date: props.filters.checkin_date ?? "",
    checkout_date: props.filters.checkout_date ?? "",
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

const priceRange = ref([form.minPrice, form.maxPrice]);

//initialize allrentals array this is after checkin and checkout filter

newArr.value = props.allrentals.filter(
    (e) =>
        e["total_bedrooms"] >= form.noOfBedrooms &&
        e["total_beds"] >= form.noOfBeds &&
        e["total_baths"] >= form.noOfBaths &&
        e["tariff"] >= form.minPrice &&
        e["tariff"] <= form.maxPrice
);

// all conditions must be met therefore we need to put all categories
const bedroomInc = () => {
    if (form.noOfBedrooms < 1) {
        form.filterCount += 1;
    }
    form.noOfBedrooms += 1;

    filterArr();
    // newArr.value = props.allrentals.filter(
    //     (e) =>
    //         e["total_bedrooms"] >= form.noOfBedrooms &&
    //         e["total_beds"] >= form.noOfBeds &&
    //         e["total_baths"] >= form.noOfBaths &&
    //         e["tariff"] >= form.minPrice &&
    //         e["tariff"] <= form.maxPrice
    // );
};

const bedroomDec = () => {
    form.noOfBedrooms -= 1;

    if (form.noOfBedrooms < 1) {
        form.filterCount -= 1;
    }
    filterArr();
    // newArr.value = props.allrentals.filter(
    //     (e) =>
    //         e["total_bedrooms"] >= form.noOfBedrooms &&
    //         e["total_beds"] >= form.noOfBeds &&
    //         e["total_baths"] >= form.noOfBaths &&
    //         e["tariff"] >= form.minPrice &&
    //         e["tariff"] <= form.maxPrice
    // );
};

const bedInc = () => {
    if (form.noOfBeds < 1) {
        form.filterCount += 1;
    }
    form.noOfBeds += 1;

    filterArr();
    // newArr.value = props.allrentals.filter(
    //     (e) =>
    //         e["total_bedrooms"] >= form.noOfBedrooms &&
    //         e["total_beds"] >= form.noOfBeds &&
    //         e["total_baths"] >= form.noOfBaths &&
    //         e["tariff"] >= form.minPrice &&
    //         e["tariff"] <= form.maxPrice
    // );
};

const bedDec = () => {
    form.noOfBeds -= 1;
    if (form.noOfBeds < 1) {
        form.filterCount -= 1;
    }

    filterArr();
    // newArr.value = props.allrentals.filter(
    //     (e) =>
    //         e["total_bedrooms"] >= form.noOfBedrooms &&
    //         e["total_beds"] >= form.noOfBeds &&
    //         e["total_baths"] >= form.noOfBaths &&
    //         e["tariff"] >= form.minPrice &&
    //         e["tariff"] <= form.maxPrice
    // );
};

const filterArr = () => {
    newArr.value = props.allrentals.filter(
        (e) =>
            e["total_bedrooms"] >= form.noOfBedrooms &&
            e["total_beds"] >= form.noOfBeds &&
            e["total_baths"] >= form.noOfBaths &&
            e["tariff"] >= form.minPrice &&
            e["tariff"] <= form.maxPrice
    );
};
const bathInc = () => {
    if (form.noOfBaths < 1) {
        form.filterCount += 1;
    }
    form.noOfBaths += 1;

    filterArr();
};

const bathDec = () => {
    form.noOfBaths -= 1;
    if (form.noOfBaths < 1) {
        form.filterCount -= 1;
    }

    filterArr();
    // newArr.value = props.allrentals.filter(
    //     (e) =>
    //         e["total_bedrooms"] >= form.noOfBedrooms &&
    //         e["total_beds"] >= form.noOfBeds &&
    //         e["total_baths"] >= form.noOfBaths &&
    //         e["tariff"] >= form.minPrice &&
    //         e["tariff"] <= form.maxPrice
    // );
};

const onPricechange = () => {
    form.minPrice = priceRange.value[0];
    form.maxPrice = priceRange.value[1];

    // if (form.minPrice > 20 || form.maxPrice < 1000) {
    //     form.filterCount += 1;
    // }
    // if (form.minPrice == 20 && form.maxPrice == 1000) {
    //     form.filterCount -= 1;
    // }
    filterArr();
    // newArr.value = props.allrentals.filter(
    //     (e) =>
    //         e["total_bedrooms"] >= form.noOfBedrooms &&
    //         e["total_beds"] >= form.noOfBeds &&
    //         e["total_baths"] >= form.noOfBaths &&
    //         e["tariff"] >= form.minPrice &&
    //         e["tariff"] <= form.maxPrice
    // );

    // console.log(form.minPrice);
};

const searchRental = () => {
    form.maxGuest = form.noOfAdults + form.noOfChildren;

    form.get(route("rental.index"));
};
</script>
