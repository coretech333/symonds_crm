<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router, useForm, Link } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { Pagination, PaginationContent, PaginationEllipsis, PaginationFirst, PaginationLast, PaginationItem, PaginationNext, PaginationPrevious } from '@/components/ui/pagination';
import { Search, Plus, Edit, Eye, Trash2 } from 'lucide-vue-next';

const props = defineProps<{
    users: {
        data: Array<Record<string, any>>;
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
        title: 'User',
        href: '/users',
    },
];

const form = useForm({
    search: props.filters?.search || '',
})

const search = () => {
    router.get(route('users.index'), { search: form.search })
};

const goToPage = (page: number) => {
    router.get(route('users.index'), { search: form.search, page }, {
        preserveState: true,
        replace: true,
    })
};
const columns = [
    { key: 'name', label: 'Name' },
    { key: 'role', label: 'Role' },
    { key: 'email', label: 'Email' },
    { key: 'mobile', label: 'Mobile' },
    { key: 'status', label: 'Status' },
    { key: 'createAt', label: 'Created At' }
]
</script>

<template>

    <Head title="Users" />

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
                            Create Users
                        </button>
                    </div>
                </div>

                <!-- Tables -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th v-for="column in columns" :key="column.key"
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider cursor-pointer hover:bg-gray-100 transition-colors">
                                    <div class="flex items-center space-x-1">
                                        <span>{{ column.label }}</span>
                                    </div>
                                </th>
                                <th
                                    class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-if="props.users.data.length != 0" v-for="user in props.users.data" :key="user?.id"
                                class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div
                                                class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                                                <span class="text-sm font-medium text-white">{{ user.name.charAt(0)
                                                }}</span>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ user?.name }}</div>
                                            <div class="text-sm text-gray-500">{{ user?.email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ user.role_id }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ user.email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ user.mobile || 'not available' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span :class="[
                                        'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium',
                                        user.status === 1
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-red-100 text-red-800'
                                    ]">
                                        <div :class="[
                                            'w-1.5 h-1.5 rounded-full mr-1.5',
                                            user.status === 1 ? 'bg-green-500' : 'bg-red-500'
                                        ]"></div>
                                        {{ user.status === 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ user.created_at }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
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
                                </td>
                            </tr>

                            <!-- Empty State -->
                            <tr v-if="props.users.data.length === 0">
                                <td colspan="7" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                            <Search class="w-6 h-6 text-gray-400" />
                                        </div>
                                        <h3 class="text-sm font-medium text-gray-900 mb-1">No User found</h3>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Showing 1 to 10 of {{ props.users.total }} results
                        </div>
                        <div class="flex items-center space-x-2">
                            <Pagination v-slot="{ page }" :items-per-page="props.users.per_page"
                                :total="props.users.total" :sibling-count="1" show-edges
                                :default-page="props.users.current_page" @update:page="goToPage">
                                <PaginationContent v-slot="{ items }" class="flex items-center gap-1">
                                    <PaginationFirst />
                                    <PaginationPrevious />

                                    <template v-for="(item, index) in items">
                                        <PaginationItem v-if="item.type === 'page'" :key="index" :value="item.value"
                                            as-child>
                                            <Button class="w-10 h-10 p-0"
                                                :variant="item.value === page ? 'default' : 'outline'">
                                                {{ item.value }}
                                            </Button>
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