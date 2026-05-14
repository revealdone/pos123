<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ref, computed } from "vue";

defineOptions({
    layout: AdminLayout,
});

const props = defineProps({
    products: Array,
});

const search = ref("");

const filteredProducts = computed(() => {
    return props.products.filter((product) => {
        return product.name.toLowerCase().includes(search.value.toLowerCase());
    });
});
</script>

<template>
    <div class="p-6">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Products</h1>

            <Link
                href="/products/create"
                class="bg-blue-500 text-white px-4 py-2 rounded"
            >
                Add Product
            </Link>
        </div>

        <!-- SEARCH -->
        <input
            v-model="search"
            type="text"
            placeholder="Search product..."
            class="border p-2 rounded mb-4 w-full"
        />

        <!-- TABLE -->
        <div class="overflow-x-auto">
            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2 flex gap-2">No</th>
                        <th class="border p-2">Barcode</th>
                        <th class="border p-2">Name</th>
                        <th class="border p-2">Category</th>
                        <th class="border p-2">Stock</th>
                        <th class="border p-2">Sell Price</th>
                        <th class="border p-2">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- EMPTY STATE -->
                    <tr v-if="filteredProducts.length === 0">
                        <td colspan="7" class="text-center p-6 text-gray-500">
                            Product not found
                        </td>
                    </tr>

                    <!-- PRODUCT LOOP -->
                    <tr
                        v-for="(product, index) in filteredProducts"
                        :key="product.id"
                    >
                        <td class="border p-2">
                            {{ index + 1 }}
                        </td>

                        <td class="border p-2 text-center">
                            {{ product.barcode }}
                        </td>

                        <td class="border p-2 text-center">
                            {{ product.name }}
                        </td>

                        <td class="border p-2 text-center">
                            {{ product.category?.name }}
                        </td>

                        <td
                            class="border p-2 font-bold text-center"
                            :class="
                                product.stock < 10
                                    ? 'text-red-500'
                                    : 'text-green-500'
                            "
                        >
                            {{ product.stock }}
                        </td>

                        <td class="border p-2 text-center">
                            Rp {{ product.selling_price }}
                        </td>

                        <td class="border p-2 flex gap-2 text-center">
                            <Link
                                :href="`/products/${product.id}/edit`"
                                class="bg-yellow-500 text-white px-3 py-1 rounded"
                            >
                                Edit
                            </Link>

                            <Link
                                :href="`/products/${product.id}`"
                                method="delete"
                                as="button"
                                class="bg-red-500 text-white px-3 py-1 rounded"
                            >
                                Delete
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
