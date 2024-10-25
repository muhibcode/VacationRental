<template>
    <div>
        My Profile
        <br />
        <Link
            v-if="props.user.rental.length > 0"
            :href="route('mybookplaces.show', $page.props.auth.user.id)"
        >
            My Currently Booked Places
        </Link>
        <br />
        <Link :href="route('booking.index')"> My Bookings </Link>
        <Card />
    </div>
</template>

<script setup>
import Card from "@/Components/Card.vue";
import { Link } from "@inertiajs/vue3";
const props = defineProps({
    user: Object,
});
console.log(props.user);
</script>
