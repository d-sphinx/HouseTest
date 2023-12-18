<template>
    <div>

        <form>
            <div>
                <label for=“name”>Name:</label>
                <input id=“name” type=“text” v-model="name" @click="search"/>
            </div>
            <div>
                <label for=“bedrooms”>Bedrooms:</label>
                <input id=“bedrooms” type=“number” v-model="bedrooms"/>
            </div>
            <div>
                <label for=“bathrooms”>Bathrooms:</label>
                <input id=“bathrooms” type=“number” v-model="bathrooms"/>
            </div>
            <div>
                <label for=“storeys”>Storeys:</label>
                <input id=“storeys” type=“number” v-model="storeys"/>
            </div>
            <div>
                <label for=“garages”>Garages:</label>
                <input id=“garages” type=“number” v-model="garages"/>
            </div>
            <div>
                <label for=“price-min”>Price min:</label>
                <input id=“price-min” type=“number” v-model="price_min"/>
            </div>
            <div>
                <label for=“price-max”>Price max:</label>
                <input id=“price-max” type=“number” v-model="price_max"/>
            </div>
        </form>

        <table v-if="results.length" style="width: 100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Bedrooms</th>
                <th>Bathrooms</th>
                <th>Storeys</th>
                <th>Garages</th>
                <th>Price</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="result in results" :key="result.id">
                <td>{{ result.name }}</td>
                <td>{{ result.bedrooms }}</td>
                <td>{{ result.bathrooms }}</td>
                <td>{{ result.storeys }}</td>
                <td>{{ result.garages }}</td>
                <td>{{ result.price }}</td>
            </tr>
            </tbody>
        </table>

        <p v-else>No results found.</p>

    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            name: '',
            bedrooms: null,
            bathrooms: null,
            storeys: null,
            garages: null,
            price_min: null,
            price_max: null,
            results: [],
            loading: false,
            currentPage: 1,
        };
    },
    watch: {
        name: function () {
            this.search();
        },
        bedrooms: function () {
            this.search();
        },
        bathrooms: function () {
            this.search();
        },
        storeys: function () {
            this.search();
        },
        garages: function () {
            this.search();
        },
        price_min: function () {
            this.search();
        },
        price_max: function () {
            this.search();
        },
    },
    methods: {
        async search() {
            this.loading = true;

            try {
                const response = await axios.get('/api/houses/search', {
                    params: {
                        name: this.name,
                        bedrooms: this.bedrooms,
                        bathrooms: this.bathrooms,
                        storeys: this.storeys,
                        garages: this.garages,
                        price_min: this.price_min,
                        price_max: this.price_max,
                    },
                });

                this.results = response.data;
            } catch (error) {
                console.error(error);
            }

            this.loading = false;
        },
        handlePageChange(page) {
            this.currentPage = page;
        },
    },
};
</script>
