<script setup lang="ts">
import AppLogoIcon from '@/components/AppLogoIcon.vue';
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10 bg-slate-700">
        <div class="w-full max-w-sm">
            <div class="flex flex-col gap-8">
                <div class="flex flex-col items-center gap-4">
                    <Link :href="route('home')" class="flex flex-col items-center gap-2 font-medium">
                        <div class="mb-1 flex h-9 w-9 items-center justify-center rounded-md">
                            <AppLogoIcon class="size-9 fill-current text-[var(--foreground)] dark:text-white" />
                            <div class="text-center mb-8">
                                <div class="mb-4">
                                    <div class="w-16 h-16 mx-auto bg-red-600 rounded-full flex items-center justify-center">
                                        <span class="text-white text-2xl font-bold">SY</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </Link>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
