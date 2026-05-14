<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";

defineOptions({
    layout: AdminLayout,
});

defineProps({
    transactions: Array,
});
</script>

<form method="GET" action="/reports" class="flex gap-4 mb-4">

</form>

<template>
    <div class="p-6">
        <h1 class="text-3xl font-bold mb-6">Sales Report</h1>

        <form method="GET" action="/reports" class="flex gap-4 mb-4">
            <input type="date" name="start_date" class="border p-2" />

            <input type="date" name="end_date" class="border p-2" />

            <button class="bg-blue-500 text-white px-4 py-2 rounded">
                Filter
            </button>
        </form>
        <div class="mb-4">
            <a
                href="/reports/pdf"
                target="_blank"
                class="bg-red-500 text-white px-4 py-2 rounded"
            >
                Export PDF
            </a>
        </div>
        <div
            class="overflow-x-auto overflow-y-auto max-h-[500px] border rounded shadow"
        >
            <table class="w-full border">
                <thead class="bg-gray-100 sticky top-0 z-10">
                    <tr>
                        <th class="border p-2">Invoice</th>
                        <th class="border p-2">Total</th>
                        <th class="border p-2">Paid</th>
                        <th class="border p-2">Change</th>
                        <th class="border p-2">Date</th>
                        <th class="border p-2">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr
                        v-for="transaction in transactions"
                        :key="transaction.id"
                    >
                        <td class="border p-2 text-center">
                            {{ transaction.invoice_number }}
                        </td>

                        <td class="border p-2 text-center">
                            Rp {{ transaction.total_price ?? 0 }}
                        </td>

                        <td class="border p-2 text-center">
                            Rp {{ transaction.paid_amount ?? 0 }}
                        </td>

                        <td class="border p-2 text-center">
                            Rp {{ transaction.change_amount ?? 0 }}
                        </td>

                        <td class="border p-2 text-center">
                            {{ transaction.transaction_date }}
                        </td>

                        <td class="border p-2 text-center">
                            <div class="flex justify-center gap-2">
                                <a
                                    :href="`/transactions/${transaction.id}/print`"
                                    target="_blank"
                                    class="bg-green-500 text-white px-3 py-1 rounded"
                                >
                                    Print
                                </a>
                                <!-- 
                                <a
                                    href="/reports/pdf"
                                    target="_blank"
                                    class="bg-red-500 text-white px-3 py-1 rounded"
                                >
                                    PDF
                                </a> -->
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
