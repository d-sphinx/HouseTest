<template>
    <div>
        <el-form label-width="80px">
            <el-row>
                <el-col :span="16">
                    <el-form-item label="Name:">
                        <el-input
                            type="text"
                            v-model="name"
                            placeholder="Search..."
                            @click.native="search"
                            clearable
                        >
                            <template slot="prepend">
                                <i class="el-input__icon el-icon-search"></i>
                            </template>
                        </el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="4">
                    <el-form-item label="Bedrooms:">
                        <el-input-number
                            :min="0"
                            :max="10"
                            type="number"
                            v-model="bedrooms"
                        ></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :span="4">
                    <el-form-item label="Bathrooms:">
                        <el-input-number
                            :min="0"
                            :max="10"
                            type="number"
                            v-model="bathrooms"
                        ></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :span="4">
                    <el-form-item label="Storeys:">
                        <el-input-number
                            :min="0"
                            :max="10"
                            type="number"
                            v-model="storeys"
                        ></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :span="4">
                    <el-form-item label="Garages:">
                        <el-input-number
                            :min="0"
                            :max="10"
                            type="number"
                            v-model="garages"
                        ></el-input-number>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row>
                <el-col :span="4">
                    <el-form-item label="Price min:">
                        <el-input-number type="number" v-model="price_min"></el-input-number>
                    </el-form-item>
                </el-col>
                <el-col :span="4">
                    <el-form-item label="Price max:">
                        <el-input-number type="number" v-model="price_max"></el-input-number>
                    </el-form-item>
                </el-col>
            </el-row>
        </el-form>

        <el-table
            v-if="results.length"
            :data="results"
            style="width: 100%"
            size="small"
        >
            <el-table-column prop="name" label="Name" width="260"></el-table-column>
            <el-table-column prop="bedrooms" label="Bedrooms" width="120"></el-table-column>
            <el-table-column prop="bathrooms" label="Bathrooms" width="120"></el-table-column>
            <el-table-column prop="storeys" label="Storeys" width="120"></el-table-column>
            <el-table-column prop="garages" label="Garages" width="120"></el-table-column>
            <el-table-column prop="price" label="Price"></el-table-column>
        </el-table>

        <el-empty
            v-else
            description="No results found."
        ></el-empty>
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
    mounted() {
        window.onload = () => {
            this.search();
        };
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
