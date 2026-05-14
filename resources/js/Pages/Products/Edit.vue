<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    product: Object,
    categories: Array,
});

const form = useForm({
    category_id: props.product.category_id,
    name: props.product.name,
    barcode: props.product.barcode,
    purchase_price: props.product.purchase_price,
    selling_price: props.product.selling_price,
    stock: props.product.stock,
    unit: props.product.unit,
});

const submit = () => {
    form.put(`/products/${props.product.id}`);
};
</script>

<template>
    <div class="p-6 max-w-xl bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Edit Product</h1>

        <form @submit.prevent="submit">
            <div class="mb-4">
                <label>Category</label>

                <select v-model="form.category_id" class="border w-full p-2">
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
            </div>

            <div class="mb-4">
                <label>Product Name</label>

                <input
                    v-model="form.name"
                    type="text"
                    class="border w-full p-2"
                />
            </div>

            <div class="mb-4">
                <label>Barcode</label>

                <input
                    v-model="form.barcode"
                    type="text"
                    class="border w-full p-2"
                />
            </div>

            <div class="mb-4">
                <label>Purchase Price</label>

                <input
                    v-model="form.purchase_price"
                    type="number"
                    class="border w-full p-2"
                />
            </div>

            <div class="mb-4">
                <label>Selling Price</label>

                <input
                    v-model="form.selling_price"
                    type="number"
                    class="border w-full p-2"
                />
            </div>

            <div class="mb-4">
                <label>Stock</label>

                <input
                    v-model="form.stock"
                    type="number"
                    class="border w-full p-2"
                />
            </div>

            <div class="mb-4">
                <label>Unit</label>

                <input
                    v-model="form.unit"
                    type="text"
                    class="border w-full p-2"
                />
            </div>

            <div class="flex gap-2">
                <a
                    href="/products"
                    class="bg-gray-500 text-white px-4 py-2 rounded"
                >
                    Back
                </a>

                <button
                    :disabled="form.processing"
                    class="bg-yellow-500 text-white px-4 py-2 rounded"
                >
                    {{ form.processing ? "Updating..." : "Update" }}
                </button>
            </div>
        </form>
    </div>
</template>
