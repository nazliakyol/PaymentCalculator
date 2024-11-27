<template>
    <form v-on:submit.prevent="create">
        <div>
            <div>
                <label>Beds</label>
                <input type="text" v-model.number="form.beds"/>
                <div v-if="form.errors.beds"> {{ form.errors.beds }}</div>
            </div>
            <div>
                <label>Baths</label>
                <input type="text" v-model.number="form.baths"/>
            </div>
            <div>
                <label>Area</label>
                <input type="text" v-model.number="form.area"/>
            </div>
            <div>
                <label>City</label>
                <input type="text" v-model.number="form.city"/>
            </div>
            <div>
                <label>Post Code</label>
                <input type="text" v-model.number="form.postcode"/>
            </div>
            <div>
                <label>Street</label>
                <input type="text" v-model.number="form.street" />
            </div>
            <div>
                <label>Street Number</label>
                <input type="text" v-model.number="form.setreet_nr"/>
            </div>
            <div>
                <label>Price</label>
                <input type="text" v-model.number="form.price"/>
            </div>
            <div>
                <button type="submit">Create</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    beds: 0,
    baths: 0,
    area: 0,
    city: "",
    postCode: "",
    street: "",
    street_nr: "",
    price: 0,
});

const create = () => {
    form.post("/listing");
}
// form.beds = 5;

</script>
<style scoped>

    div {
        display: block;
        justify-items: end;
        padding: 0.5rem;
    }
    label {
        font-weight: bold;
        padding: 2rem 2rem;
    }

</style>
