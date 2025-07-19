<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, useForm, Link } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { Pagination, PaginationContent, PaginationEllipsis, PaginationFirst, PaginationLast, PaginationItem, PaginationNext, PaginationPrevious } from '@/components/ui/pagination';
import { Search, Plus, Edit, Eye, Trash2 } from 'lucide-vue-next';

const props = defineProps<{
    sports: {
        data: Array<Record<string, any>>;
        from: number
        to: number
        current_page: number
        last_page: number
        per_page: number
        total: number
    };
    filters: {
        search: string
    };
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Sport',
        href: '/sports',
    },
];

const form = useForm({
    search: props.filters?.search || '',
})

const search = () => {
    router.get(route('sports.index'), { search: form.search })
};

const goToPage = (page: number) => {
    router.get(route('sports.index'), { search: form.search, page }, {
        preserveState: true,
        replace: true,
    })
};
const columns = [
    { key: 'icon', label: 'Icon' },
    { key: 'sports', label: 'Sport' },
    { key: 'status', label: 'Status' },
    { key: 'created', label: 'Created At' },
]
</script>

<template>

    <Head title="Sports" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col h-[calc(100vh-80px)] p-4 gap-4 rounded-xl overflow-hidden">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-6 mt-4">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-center gap-4">
                        <div class="relative flex-1 max-w-md">
                            <Search class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" />
                            <input v-model="form.search" @input="search" type="text" placeholder="Search Email, Name..."
                                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg" />
                        </div>
                        <button
                            class="px-4 py-2.5 bg-gradient-to-r from-red-500 to-blue-600 text-white font-semibold rounded-xl hover:from-red-600 hover:to-blue-700 transition-all duration-200 flex items-center gap-2">
                            <Plus class="w-4 h-4" />
                            Create Sports
                        </button>
                    </div>
                </div>

                <!-- Tables -->
                <div class="overflow-x-auto">
                    <Table class="w-full">
                        <TableHeader class="bg-gray-50 border-b border-gray-200">
                            <TableRow>
                                <TableHead v-for="column in columns" :key="column.key"
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors border">
                                    <div class="flex items-center space-x-1">
                                        <span>{{ column.label }}</span>
                                    </div>
                                </TableHead>
                                <TableHead
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Actions
                                </TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody class="bg-white divide-y divide-gray-200">
                            <TableRow v-if="props.sports.data.length != 0" v-for="sport in props.sports.data" :key="sport?.id"
                                class="hover:bg-gray-50 transition-colors">

                                <TableCell class="px-6 py-4 whitespace-nowrap border text-sm text-gray-900">
                                    {{ sport.icon }}
                                </TableCell>
                                <TableCell class="px-6 py-4 whitespace-nowrap border text-sm text-gray-900">
                                    {{ sport.title || 'not available' }}
                                </TableCell>
                                <TableCell class="px-6 py-4 whitespace-nowrap border">
                                    <span :class="[
                                        'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                        sport.status === 1
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-red-100 text-red-800'
                                    ]">
                                        <div :class="[
                                            'w-1.5 h-1.5 rounded-full mr-1.5',
                                            sport.status === 1 ? 'bg-green-500' : 'bg-red-500'
                                        ]"></div>
                                        {{ sport.status === 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </TableCell>
                                <TableCell class="px-6 py-4 whitespace-nowrap border text-sm text-gray-500">
                                    {{ sport.created_at }}
                                </TableCell>
                                <TableCell class="px-6 py-4 whitespace-nowrap border text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <button
                                            class="text-blue-600 hover:text-blue-900 p-1 hover:bg-blue-50 rounded transition-colors">
                                            <Eye class="w-6 h-6" />
                                        </button>
                                        <button
                                            class="text-green-600 hover:text-green-900 p-1 hover:bg-green-50 rounded transition-colors">
                                            <Edit class="w-6 h-6" />
                                        </button>
                                        <button
                                            class="text-red-600 hover:text-red-900 p-1 hover:bg-red-50 rounded transition-colors">
                                            <Trash2 class="w-6 h-6" />
                                        </button>
                                    </div>
                                </TableCell>
                            </TableRow>

                            <!-- Empty State -->
                            <tr v-if="props.sports.data.length === 0">
                                <TableCell colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <Search class="w-6 h-6 text-gray-400" />
                                        </div>
                                        <h3 class="text-sm font-medium text-gray-900 mb-1">No Sport found</h3>
                                    </div>
                                </TableCell>
                            </tr>
                        </TableBody>
                    </Table>
                </div>
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing {{ props.sports.from || 0 }} to {{ props.sports.to || 0 }} of {{ props.sports.total || 0 }} results
                        </div>
                        <div class="flex items-center space-x-2">
                            <Pagination v-slot="{ page }" :items-per-page="props.sports.per_page"
                                :total="props.sports.total" :sibling-count="1" show-edges
                                :default-page="props.sports.current_page" @update:page="goToPage">
                                <PaginationContent v-slot="{ items }" class="flex items-center gap-1">
                                    <PaginationFirst />
                                    <PaginationPrevious />

                                    <template v-for="(item, index) in items">
                                        <PaginationItem v-if="item.type === 'page'" :key="index" :value="item.value"
                                            as-child>
                                            <button class="w-10 h-10 p-0 bg-gradient-to-r from-red-500 to-blue-600 text-white hover:from-red-600 hover:to-blue-700"
                                                :variant="item.value === page ? 'default' : 'outline'">
                                                {{ item.value }}
                                            </button>
                                        </PaginationItem>
                                        <PaginationEllipsis v-else :key="item.type" :index="index" />
                                    </template>
                                    <PaginationNext />
                                    <PaginationLast />
                                </PaginationContent>
                            </Pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>

</template>
