<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({
    layout: AdminLayout,
});
import { Link } from "@inertiajs/vue3";

defineProps({
    categories: Array,
});
</script>

<template>
    <div class="p-6">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Categories</h1>

            <Link
                href="/categories/create"
                class="bg-blue-500 text-white px-4 py-2 rounded"
            >
                Add Category
            </Link>
        </div>

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border flex gap-1">No</th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Description</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(category, index) in categories" :key="category.id">
                    <td class="p-2 border">
                        {{ index + 1 }}
                    </td>

                    <td class="p-2 border text-center">
                        {{ category.name }}
                    </td>

                    <td class="p-2 border text-center">
                        {{ category.description }}
                    </td>

                    <td class="p-2 border flex gap-2">
                        <Link
                            :href="`/categories/${category.id}/edit`"
                            class="bg-yellow-500 text-white px-3 py-1 rounded"
                        >
                            Edit
                        </Link>

                        <Link
                            :href="`/categories/${category.id}`"
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
</template>
