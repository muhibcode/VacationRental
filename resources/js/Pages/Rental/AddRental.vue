<template>
    <!-- <form @submit.prevent="submit"> -->
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
        <div class="mt-5">
            <InputLabel for="tariff" value="Rental Type" />

            <input
                id="tariff"
                type="text"
                class="mt-1 block w-full"
                v-model="form.rentalType"
            />

            <!-- <InputError class="mt-2" :message="form.errors.baths" /> -->
        </div>
        <div class="mt-5">
            <InputLabel for="tariff" value="Total Baths" />

            <input
                id="tariff"
                type="text"
                class="mt-1 block w-full"
                v-model="form.totalBaths"
            />

            <!-- <InputError class="mt-2" :message="form.errors.baths" /> -->
        </div>
        <div class="mt-5">
            <InputLabel for="tariff" value="Max Guest" />

            <input
                id="tariff"
                type="text"
                class="mt-1 block w-full"
                v-model="form.maxGuest"
            />

            <!-- <InputError class="mt-2" :message="form.errors.baths" /> -->
        </div>
        <!-- <div class="mt-5">
            <InputLabel for="tariff" value="Max Adults" />

            <input
                id="tariff"
                type="text"
                class="mt-1 block w-full"
                v-model="form.maxAdults"
            />

        </div> -->
        <div>
            <h2>Amenities</h2>
            <div v-for="(item, index) in amenities" :key="index">
                <input
                    type="checkbox"
                    :id="item.title"
                    :name="item.title"
                    :value="item.title"
                    @change="clickchk($event)"
                />
                <label :for="item.title"> {{ item.title }} </label>
            </div>
        </div>
        <br />
        <button :onclick="makeRooms">Add Rooms</button>
        <div v-for="(item, index) in roomArr" :key="index">
            <h1>Room # {{ index + 1 }}</h1>
            <h1>Total Beds in Room#{{ index + 1 }}:{{ noOfBeds }}</h1>

            <button :onclick="() => makeBeds(index)">Add Beds</button>
            <div v-for="(item, j) in form.bedType[index]" :key="j">
                <div class="mt-5">
                    <InputLabel for="bedtype" value="BedType of room #" />
                    <input
                        :id="j"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.bedType[index][j]"
                    />
                </div>
            </div>
        </div>
        <br />
        <br />
        <!-- <button :onclick="savebeds">Save Beds</button> -->
    </div>

    <PrimaryButton
        :onclick="submit"
        class="mt-10 ml-10 ms-4"
        :class="{ 'opacity-25': form.processing }"
        :disabled="form.processing"
    >
        Register
    </PrimaryButton>
    <!-- </form> -->
</template>
<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { reactive, ref } from "vue";
import axios from "axios";
import { useForm } from "@inertiajs/vue3";

let roomArr = ref([]);
let bedArr = ref([]);

let noOfBeds = 0;
let noOfRooms = 0;
let amenity = [];
let bedType = "";
const props = defineProps({
    amenities: Array,
});

// let bedrooms = [{'roomno':0,'noofbed':0,'bedtypes':['','','']},
//     {'roomno':0,'noofbed':0,'bedtypes':['','','']}]

const form = useForm({
    name: "",
    city: "",
    address: "",
    tariff: "",
    rentalType: "",
    amenities: [],
    maxGuest: 0,
    noOfRooms: 0,
    totalBeds: 0,
    totalBaths: 0,
    roomNo: [],
    noOfBeds: [],
    bedType: [],
});

// const savebeds = ()=>{
//     console.log(form.bedTypes);
// }

// const addvals = (ind)=>{
//     console.log(bedtype);
//     form.bedTypes[ind] = bedtype
// }

const makeRooms = () => {
    roomArr.value.push(0);

    noOfRooms += 1;
    form.roomNo.push(noOfRooms.toString());
    form.noOfBeds.push(0);
    form.bedType.push([]);
    form.noOfRooms = noOfRooms;
};

const makeBeds = (ind) => {
    //adding bed and adding its type
    let temp = form.noOfBeds[ind];
    temp = temp + 1;
    form.noOfBeds[ind] = temp;
    form.bedType[ind].push("");
    form.totalBeds += 1;
};
const clickchk = (e) => {
    const ind = form.amenities.indexOf(e.target.value);
    if (ind != -1) {
        form.amenities.splice(ind, 1);
    } else {
        form.amenities.push(e.target.value);
    }
    console.log(form.amenities);
};
const submit = () => {
    // console.log(form.amenities);

    form.post(route("rental.store"));
};
// {date:
//     activity[]
// }
// defineProps({ listing: String })
</script>
