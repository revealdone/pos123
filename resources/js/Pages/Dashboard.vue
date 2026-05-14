<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({
    layout: AdminLayout,
});

defineProps({
    totalProducts: Number,
    totalTransactions: Number,
    totalRevenue: Number,
    lowStockProducts: Array,
    totalProfit: Number,
    totalAsset: Number,
    netProfit: Number,
});
</script>

<template>
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6">Dashboard POS Pak Toni</h1>

        <!-- CARD -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4 mb-8">
            <div class="bg-blue-500 text-white p-6 rounded">
                <h2 class="text-lg">Total Products</h2>

                <p class="text-3xl font-bold mt-2">
                    {{ totalProducts }}
                </p>
            </div>

            <div class="bg-green-500 text-white p-6 rounded">
                <h2 class="text-lg">Total Transaksi</h2>

                <p class="text-3xl font-bold mt-2">
                    {{ totalTransactions }}
                </p>
            </div>

            <div class="bg-yellow-500 text-white p-6 rounded">
                <h2 class="text-lg">Pendapatan Kotor</h2>

                <p class="text-2xl font-bold mt-2 break-words">
                    Rp {{ Number(totalRevenue).toLocaleString() }}
                </p>
            </div>
            <div class="bg-green-700 text-white p-6 rounded">
                <h2 class="text-lg">Keuntungan Bersih</h2>

                <p class="text-2xl font-bold mt-2 break-words">
                    Rp {{ Number(netProfit).toLocaleString() }}
                </p>
            </div>
            <div class="bg-purple-500 text-white p-6 rounded">
                <h2 class="text-lg">Profit Estimation</h2>

                <p class="text-2xl font-bold mt-2 break-words">
                    Rp {{ Number(totalProfit).toLocaleString() }}
                </p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4 mb-8">
            <div class="bg-indigo-500 text-white p-6 rounded">
                <h2 class="text-lg">Total Asset</h2>

                <p class="text-2xl font-bold mt-2 break-words">
                    Rp {{ Number(totalAsset).toLocaleString() }}
                </p>
            </div>
        </div>

        <!-- LOW STOCK -->
        <div class="bg-white border rounded p-4 shadow">
            <h2 class="text-2xl font-bold mb-4">Low Stock Products</h2>
            <div class="max-h-[300px] overflow-y-auto">
                <table class="w-full border">
                    <thead class="bg-gray-100 sticky top-0">
                        <tr>
                            <th class="border p-3 text-left">Product</th>
                            <th class="p-3 text-center">Stock</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr
                            v-for="product in lowStockProducts"
                            class="hover:bg-red-50"
                            :key="product.id"
                        >
                            <td class="border p-3">
                                {{ product.name }}
                            </td>

                            <td
                                class="border p-3 text-center text-red-500 font-bold"
                            >
                                {{ product.stock }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
