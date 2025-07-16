<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Table, TableHead, TableCell, TableHeader, TableRow } from '@/components/ui/table';
import { reactive, ref, computed } from 'vue';

interface Sport {
    id: number;
    title: string;
    status: boolean;
}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Sports',
        href: '/sports',
    },
];

// 🟢 Make sports reactive
const sports = reactive<Sport[]>([
    { id: 1, title: 'Football', status: true },
    { id: 2, title: 'Basketball', status: false },
    { id: 3, title: 'Tennis', status: true },
    { id: 4, title: 'Cricket', status: false },
    { id: 5, title: 'Hockey', status: true },
]);

const searchQuery = ref('');

// 🆕 Computed filtered sports
const filteredSports = computed(() =>
    sports.filter((sport) =>
        sport.title.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
);

// Toggle function
function toggleStatus(sport: Sport) {
    sport.status = !sport.status;
    console.log(`Toggled status for ${sport.title}: ${sport.status}`);
}
</script>

<template>
    <Head title="Sports" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Sports</h1>

            <!-- 🆕 Search Bar -->

            <!-- Table -->
            <div class="overflow-x-auto rounded-lg shadow">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead>ID</TableHead>
                            <TableHead>Title</TableHead>
                            <TableHead>Status</TableHead>
                        </TableRow>
                    </TableHeader>

                    <tbody>
                        <TableRow
                            v-for="sport in filteredSports"
                            :key="sport.id"
                            class="hover:bg-gray-50 transition-colors"
                        >
                            <TableCell>{{ sport.id }}</TableCell>
                            <TableCell>{{ sport.title }}</TableCell>
                            <TableCell>
                                <button
                                    @click="toggleStatus(sport)"
                                    :class="[
                                        'px-3 py-1 rounded-full text-sm font-medium focus:outline-none transition-colors',
                                        sport.status
                                            ? 'bg-green-500 text-white hover:bg-green-600'
                                            : 'bg-gray-300 text-gray-700 hover:bg-gray-400'
                                    ]"
                                >
                                    {{ sport.status ? 'ON' : 'OFF' }}
                                </button>
                            </TableCell>
                        </TableRow>

                        <!-- No results -->
                        <tr v-if="filteredSports.length === 0">
                            <td colspan="3" class="text-center py-4 text-gray-500">
                                No sports found.
                            </td>
                        </tr>
                    </tbody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>
