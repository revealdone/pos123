<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    description: "",
});

// const submit = () => {
//     form.post("/categories");
// };
const submit = () => {
    if (!form.name) {
        alert("Category name wajib diisi");

        return;
    }

    form.post("/categories");
};
</script>

<template>
    <div class="p-6 max-w-xl bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Create Category</h1>

        <form @submit.prevent="submit">
            <div class="mb-4">
                <label>Name</label>

                <input
                    v-model="form.name"
                    type="text"
                    class="border w-full p-2"
                />
                <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                    {{ form.errors.name }}
                </p>
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
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    {{ form.processing ? "Saving..." : "Save" }}
                </button>
            </div>
        </form>
    </div>
</template>
