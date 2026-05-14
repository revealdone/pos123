<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    category: Object,
});

const form = useForm({
    name: props.category.name,
    description: props.category.description,
});

const submit = () => {
    form.put(`/categories/${props.category.id}`);
};
</script>

<template>
    <div class="p-6 max-w-xl bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Edit Category</h1>

        <form @submit.prevent="submit">
            <div class="mb-4">
                <label>Name</label>

                <input
                    v-model="form.name"
                    type="text"
                    class="border w-full p-2"
                />
            </div>

            <div class="mb-4">
                <label>Description</label>

                <textarea
                    v-model="form.description"
                    class="border w-full p-2"
                ></textarea>
            </div>

            <div class="flex gap-2">
                <a
                    href="/categories"
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
