<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import axios from "axios";

defineOptions({
    layout: AdminLayout,
});

const props = defineProps({
    products: Array,
});

// const page = usePage();

// onMounted(() => {
//     const flash = page.props.flash;

//     if (flash?.success) {
//         alert(flash.success);

//         if (flash.print_url) {
//             window.open(flash.print_url, "_blank");
//         }
//     }
// });

const cart = ref([]);

const paid = ref(0);

const addToCart = (product) => {
    const existing = cart.value.find((item) => item.id === product.id);

    if (existing) {
        existing.qty++;
    } else {
        cart.value.push({
            ...product,
            qty: 1,
        });
    }
};

const total = computed(() => {
    return cart.value.reduce((sum, item) => {
        return sum + item.qty * item.selling_price;
    }, 0);
});

const change = computed(() => {
    return paid.value - total.value;
});

const form = useForm({
    items: cart,
    total_price: total,
    paid_amount: paid,
    change_amount: change,
});

// const checkout = () => {
//     form.transform(() => ({
//         items: cart.value,
//         total_price: total.value,
//         paid_amount: paid.value,
//         change_amount: change.value,
//     })).post("/pos/checkout");
// };

const checkout = async () => {
    try {
        const response = await axios.post("/pos/checkout", {
            items: cart.value,
            total_price: total.value,
            paid_amount: paid.value,
            change_amount: change.value,
        });

        if (response.data.success) {
            alert(response.data.message);

            window.open(response.data.print_url, "_blank");

            cart.value = [];
            paid.value = 0;
        }
    } catch (error) {
        alert("Checkout gagal");

        console.log(error);
    }
};
</script>

<template>
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6">POS Kasir</h1>

        <div class="grid grid-cols-2 gap-6">
            <!-- PRODUCT LIST -->
            <!-- PRODUCT LIST -->
            <div>
                <h2 class="text-xl font-bold mb-4">Product List</h2>

                <!-- SCROLL AREA -->
                <div
                    class="grid grid-cols-2 gap-4 max-h-[600px] overflow-y-auto pr-2"
                >
                    <div
                        v-for="product in products"
                        :key="product.id"
                        class="bg-white border rounded-lg p-4 shadow-sm hover:shadow-md transition"
                    >
                        <h3 class="font-bold text-lg mb-2">
                            {{ product.name }}
                        </h3>

                        <p class="text-sm text-gray-500 mb-1">
                            Stock:
                            {{ product?.stock ?? 0 }}
                        </p>

                        <p class="text-green-600 font-bold mb-3">
                            Rp
                            {{
                                Number(
                                    product?.selling_price ?? 0,
                                ).toLocaleString()
                            }}
                        </p>

                        <button
                            @click="addToCart(product)"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded"
                        >
                            Add to Cart
                        </button>
                    </div>
                </div>
            </div>

            <!-- CART -->
            <div>
                <h2 class="text-xl font-bold mb-4">Cart</h2>

                <div
                    v-for="item in cart"
                    :key="item.id"
                    class="border p-3 mb-2 rounded"
                >
                    <div class="flex justify-between">
                        <div>
                            {{ item.name }}
                            x {{ item.qty }}
                        </div>

                        <div>Rp {{ item.qty * item.selling_price }}</div>
                    </div>
                </div>

                <div class="mt-6 border-t pt-4">
                    <h3 class="text-xl font-bold">Total: Rp {{ total }}</h3>

                    <div class="mt-4">
                        <label>Paid Amount</label>

                        <input
                            v-model="paid"
                            type="number"
                            class="border w-full p-2"
                        />
                    </div>

                    <h3 class="text-lg mt-4">Change: Rp {{ change }}</h3>

                    <button
                        @click="checkout"
                        class="bg-green-500 text-white px-4 py-2 rounded mt-4"
                    >
                        Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
