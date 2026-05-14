<script setup>
import { useForm } from "@inertiajs/vue3";

defineProps({
    categories: Array,
});

const form = useForm({
    category_id: "",
    name: "",
    barcode: "",
    purchase_price: "",
    selling_price: "",
    stock: "",
    unit: "",
});

// const submit = () => {
//     form.post("/products");
// };
const submit = () => {
    if (
        !form.category_id ||
        !form.name ||
        !form.barcode ||
        !form.purchase_price ||
        !form.selling_price ||
        !form.stock ||
        !form.unit
    ) {
        alert("Semua field wajib diisi");

        return;
    }

    form.post("/products");
};
</script>

<template>
    <div class="p-6 max-w-xl bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Create Product</h1>

        <form @submit.prevent="submit">
            <div class="mb-4">
                <label>Category</label>

                <select v-model="form.category_id" class="border w-full p-2">
                    <option value="">Select Category</option>

                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
                <p
                    v-if="form.errors.category_id"
                    class="text-red-500 text-sm mt-1"
                >
                    {{ form.errors.category_id }}
                </p>
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
                    placeholder="pcs / box / kg"
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
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    {{ form.processing ? "Saving..." : "Save" }}
                </button>
            </div>
        </form>
    </div>
</template>
