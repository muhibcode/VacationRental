<template>
    <!-- <Headar /> -->
    <div class="grid grid-cols-2 ml-28">
        <div class="flex">
            <div
                class="border w-full h-full ml-10 mr-1 rounded-bl-lg rounded-tl-lg"
            >
                <img
                    :src="props.rental.images[0]['src']"
                    alt=""
                    class="w-full h-full rounded-bl-md rounded-tl-md"
                />
            </div>

            <!-- <h1>{{ rental.name }}</h1>
            <h1>{{ rental.address }}</h1>
            <h1>{{ rental.tariff }}</h1>
            <h1>{{ rental.city }}</h1> -->
        </div>
        <div>
            <div class="flex">
                <div class="w-60 h-60 mr-1">
                    <img
                        :src="props.rental.images[0]['src']"
                        alt=""
                        class="w-full h-full"
                    />
                </div>
                <div class="w-60 h-60 rounded-tr-lg">
                    <img
                        :src="props.rental.images[0]['src']"
                        alt=""
                        class="w-full h-full rounded-tr-md"
                    />
                </div>
            </div>
            <div class="flex">
                <div class="w-60 h-60 mr-1 mt-1">
                    <img
                        :src="props.rental.images[0]['src']"
                        alt=""
                        class="w-full h-full"
                    />
                </div>
                <div class="w-60 h-60 mt-1 rounded-br-lg">
                    <img
                        :src="props.rental.images[0]['src']"
                        alt=""
                        class="w-full h-full rounded-br-md"
                    />
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 ml-40">
        <div>
            <div
                class="border border-black bg-white rounded-md w-full h-96 mt-10"
            >
                right
            </div>
            <div
                class="border border-black bg-white rounded-md w-full h-96 mt-10"
            >
                right
            </div>
            <div
                class="border border-black bg-white rounded-md w-full h-96 mt-10"
            >
                right
            </div>
        </div>

        <div class="flex">
            <div
                class="container border border-black bg-white rounded-md w-80 h-96 mt-10 ml-28 px-8"
            >
                <form @submit.prevent="submit">
                    <div class="w-64 mt-4">
                        <VueDatePicker
                            placeholder=" CheckIn | CheckOut"
                            v-model="date"
                            @range-start="onRangeStart"
                            @range-end="onRangeEnd"
                            :disabled-dates="days"
                            :min-date="new Date()"
                            :enableTimePicker="false"
                            :range="{ partialRange: false }"
                            multi-calendars
                        />
                        <div class="flex items-center justify-start">
                            <details class="dropdown">
                                <summary
                                    tabindex="0"
                                    role="button"
                                    class="btn m-1 w-64"
                                >
                                    Add Guest:
                                    {{ form.noOfAdults + form.noOfChildren }}
                                </summary>
                                <ul
                                    tabindex="0"
                                    class="dropdown-content menu bg-base-100 rounded-box z-[1] w-64 p-2 mt-2 mr-1 shadow"
                                >
                                    <div class="grid grid-cols-2 pl-4 pt-4">
                                        <h2 class="flex items-center">
                                            Adults
                                        </h2>
                                        <div
                                            class="flex justify-evenly items-center"
                                        >
                                            <button
                                                :disabled="form.noOfAdults < 1"
                                                class="material-symbols-outlined shadow-md btn active:shadow-none w-0 rounded-full"
                                                @click.stop.prevent="
                                                    () => (form.noOfAdults -= 1)
                                                "
                                            >
                                                remove
                                            </button>
                                            <h2>{{ form.noOfAdults }}</h2>

                                            <button
                                                :disabled="
                                                    props.rental.max_guest ==
                                                    form.noOfChildren +
                                                        form.noOfAdults
                                                "
                                                class="material-symbols-outlined shadow-md btn active:shadow-none w-0 rounded-full"
                                                @click.stop.prevent="
                                                    () => (form.noOfAdults += 1)
                                                "
                                            >
                                                add
                                            </button>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 pl-4 mt-8">
                                        <h2 class="flex items-center">
                                            Children
                                        </h2>
                                        <div
                                            class="flex justify-evenly items-center"
                                        >
                                            <button
                                                :disabled="
                                                    form.noOfChildren < 1
                                                "
                                                class="material-symbols-outlined btn shadow-md active:shadow-none w-0 rounded-full"
                                                @click.stop.prevent="
                                                    () =>
                                                        (form.noOfChildren -= 1)
                                                "
                                            >
                                                remove
                                            </button>
                                            <h2>
                                                {{ form.noOfChildren ?? 0 }}
                                            </h2>

                                            <button
                                                :disabled="
                                                    props.rental.max_guest ==
                                                    form.noOfChildren +
                                                        form.noOfAdults
                                                "
                                                class="material-symbols-outlined btn shadow-md active:shadow-none w-0 rounded-full"
                                                @click.stop.prevent="
                                                    () =>
                                                        (form.noOfChildren += 1)
                                                "
                                            >
                                                add
                                            </button>
                                        </div>
                                    </div>

                                    <div
                                        class="grid grid-cols-2 pl-4 mt-8 mb-4"
                                    >
                                        <h2 class="flex items-center">
                                            Total Guests
                                        </h2>
                                        <div
                                            class="flex justify-evenly items-center text-sm font-semibold"
                                        >
                                            <h1>
                                                {{
                                                    form.noOfAdults +
                                                    form.noOfChildren
                                                }}
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

                            <!-- <Button
                                class="btn bg-yellow-400 hover:bg-yellow-500"
                                @click.prevent="searchRental"
                            >
                                Search</Button
                            >
                            <div class="flex items-center">
                                <Button
                                    type="reset"
                                    class="btn"
                                    @click="clearFilter"
                                >
                                    Clear</Button
                                >
                            </div> -->
                        </div>
                        <h1>{{ msg }}</h1>
                        <div>
                            <h1>
                                Total amount
                                {{
                                    isNaN(Math.abs(form.totalAmount))
                                        ? 0
                                        : Math.abs(form.totalAmount)
                                }}
                            </h1>
                        </div>
                        <div class="flex justify-center">
                            <button
                                class="bg-yellow-500 hover:bg-yellow-600 flex btn"
                            >
                                Reserve
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { useForm } from "@inertiajs/vue3";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";
// import { echo } from "@/bootstrap";
// import { echo } from "@/echo";
// import Echo from "laravel-echo";

// import Pusher from "pusher-js";
// window.Pusher = Pusher;

// const echo = new Echo({
//     broadcaster: "pusher",
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
//     forceTLS: true,
// });
const msg = ref("");
const props = defineProps({
    rental: Object,
    filters: Object,
});
console.log($page.props.auth.user.id);

const date = ref([]);
const Difference_In_Days = ref(0);
const chin = ref(props.filters.checkin_date ?? "");
const cout = ref(props.filters.checkout_date ?? "");

onMounted(() => {
    console.log(window.Echo);
    window.Echo.channel("booking-notify").listen(".booking", (e) => {
        // alert(e.mess);
        msg.value = e.mess;
        console.log(e);
    });
    //     // const startDate = new Date();
    //     // const endDate = new Date(new Date().setDate(startDate.getDate() + 7));
    //     // date.value = [gCheckIn.value, gCheckOut.value];
});

let days = [];
const date1 = new Date(props.filters.checkin_date);
const date2 = new Date(props.filters.checkout_date);

const Difference_In_Time = date2.getTime() - date1.getTime();

Difference_In_Days.value = Difference_In_Time / (1000 * 3600 * 24);

const form = useForm({
    hmsg: "welcone bay new comer",
    // checkin_date: props.filters.checkin_date ?? "",
    // checkout_date: props.filters.checkout_date ?? "",
    // noOfDays: Difference_In_Days.value,
    // noOfChildren: Number(props.filters.noOfChildren ?? 0),
    // noOfAdults: Number(props.filters.noOfAdults ?? 0),
    // totalAmount: props.rental.tariff * Difference_In_Days.value ?? 0,
    // rental: props.rental.id,
    // tenant: props.filters.userID,
    //owner:props.rental.owner
});

date.value = [form.checkin_date, form.checkout_date];

form.totalAmount = computed(() => {
    const date1 = new Date(form.checkin_date);
    const date2 = new Date(form.checkout_date);

    const Difference_In_Time = date2.getTime() - date1.getTime();

    const Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

    return props.rental.tariff * Difference_In_Days;

    // console.log(Difference_In_Days);

    // form.noOfDays = Difference_In_Days;
});

// const booking=[
//     {'from':'2024-4-23','to':'2024-4-26'},
//      {'from':'2024-4-29','to':'2024-5-3'},
//     // {
//     //     'from':new Date(),'to':new Date()
//     // }
// ]
//  const book_length = booking.length;

//  const availableDays = [{
//     'from':'some dat',
//     'to':'some date'
//  },
//  {
//     'from':'some dat',
//     'to':'some date'
//  }]

//  if (book_length == 2) {

//     for (let index = 0; index < 1; index++) {
//         const element = array[index];
//         const day2 = booking[book_length-(index+1)]['from']
//     const day1 = booking[book_length-(index+2)]['to']
//     const Difference_In_Time = day2.getTime() - day1.getTime();
//     const Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);

//     if (Difference_In_Days >= 6) {
//         for (let i = 0; i <= Difference_In_Days; i++) {
//         let d = new Date();
//         d.setDate(day1.getDate() + 1);
//         avail_days.push({'from':d});

//         let e = new Date();
//         e.setDate(day2.getDate() - 1);

//         avail_days.push({'to':e});

//       }
//     }
//     }

//  }else{
//     console.log('available');
//  }

// below is the disabled dates code
if (props.rental.bookings.length > 0) {
    props.rental.bookings.forEach((e) => {
        const date1 = new Date(e["checkin_date"]);
        const date2 = new Date(e["checkout_date"]);

        const Difference_In_Time = date2.getTime() - date1.getTime();

        const Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
        // const g = date1.toLocaleDateString()
        // console.log(date1.getMonth() + 1);

        for (let i = 0; i <= Difference_In_Days; i++) {
            //    let day = date1.getDate() + i
            let month = date1.getMonth();
            let year = date1.getFullYear();
            let d = new Date();
            d.setDate(date1.getDate() + i);
            d.setMonth(month);
            d.setFullYear(year);
            console.log(d);
            days.push(d);
        }
    });
}
// console.log(days);

const submit = () => {
    form.get(route("booking.create"));
};

const onRangeStart = (value) => {
    form.checkin_date = value.toLocaleDateString();

    //  form.checkin_date = chin.value;

    //   alert(`Selected date in range is: ${value}`);
};

const onRangeEnd = (value) => {
    form.checkout_date = value.toLocaleDateString();
    // form.checkout_date = cout.value;
    //   alert(`Selected date in range is: ${value}`);
};
</script>
