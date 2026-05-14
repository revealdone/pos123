<script setup>
import { Link, usePage } from "@inertiajs/vue3";
const page = usePage();
</script>

<template>
    <div class="min-h-screen flex bg-gray-100">
        <!-- SIDEBAR -->
        <aside class="w-64 bg-gray-900 text-white">
            <div class="p-6 text-2xl font-bold border-b border-gray-700">
                POS Pak Toni
            </div>

            <nav class="p-4 space-y-2">
                <Link
                    v-if="page.props.auth.user.role === 'admin'"
                    href="/dashboard"
                    class="block px-4 py-2 rounded hover:bg-gray-700"
                >
                    Dashboard
                </Link>

                <Link
                    v-if="page.props.auth.user.role === 'admin'"
                    href="/categories"
                    class="block px-4 py-2 rounded hover:bg-gray-700"
                >
                    Categories
                </Link>

                <Link
                    v-if="page.props.auth.user.role === 'admin'"
                    href="/products"
                    class="block px-4 py-2 rounded hover:bg-gray-700"
                >
                    Products
                </Link>

                <Link
                    href="/pos"
                    class="block px-4 py-2 rounded hover:bg-gray-700"
                >
                    POS Kasir
                </Link>

                <Link
                    href="/reports"
                    class="block px-4 py-2 rounded hover:bg-gray-700"
                >
                    Reports
                </Link>
            </nav>
        </aside>

        <!-- MAIN -->
        <div class="flex-1 flex flex-col">
            <!-- NAVBAR -->
            <header class="bg-white shadow px-6 py-4 flex justify-between">
                <Link
                    href="/profile"
                    class="bg-blue-500 text-white px-4 py-2 rounded"
                >
                    Profile
                </Link>
                <h1 class="text-xl font-bold">Admin Panel</h1>

                <Link
                    href="/logout"
                    method="post"
                    as="button"
                    class="bg-red-500 text-white px-4 py-2 rounded"
                >
                    Logout
                </Link>
            </header>

            <!-- CONTENT -->
            <main class="p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
