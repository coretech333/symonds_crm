<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <AuthBase>
        <Head title="Register" />
        <div class="bg-white rounded-3xl p-6 shadow-xl">
            <form @submit.prevent="submit" class="flex flex-col gap-6">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                        <Label class="text-gray-700 text-md font-medium" for="name">Name</Label>
                        <Input id="name" type="text" required autofocus :tabindex="1" autocomplete="name" v-model="form.name" placeholder="Full name" class="h-[50px]" />
                        <InputError :message="form.errors.name" />
                    </div>
    
                    <div class="grid gap-2">
                        <Label class="text-gray-700 text-md font-medium" for="email">Email address</Label>
                        <Input id="email" type="email" required :tabindex="2" autocomplete="email" v-model="form.email" placeholder="Enter your email" class="h-[50px]"/>
                        <InputError :message="form.errors.email" />
                    </div>
    
                    <div class="grid gap-2">
                        <Label class="text-gray-700 text-md font-medium" for="password">Password</Label>
                        <Input
                            id="password"
                            type="password"
                            required
                            :tabindex="3"
                            autocomplete="new-password"
                            v-model="form.password"
                            placeholder="Password"
                            class="h-[50px]"
                        />
                        <InputError :message="form.errors.password" />
                    </div>
    
                    <div class="grid gap-2">
                        <Label class="text-gray-700 text-md font-medium" for="password_confirmation">Confirm password</Label>
                        <Input
                            id="password_confirmation"
                            type="password"
                            required
                            :tabindex="4"
                            autocomplete="new-password"
                            v-model="form.password_confirmation"
                            placeholder="Confirm password"
                            class="h-[50px]"
                        />
                        <InputError :message="form.errors.password_confirmation" />
                    </div>
    
                    <Button
                      type="submit"
                      class="w-full h-[50px] bg-gradient-to-r from-red-500 to-blue-600 text-white font-semibold py-2 px-4 rounded-xl hover:from-red-600 hover:to-blue-700 transition-all duration-200 mt-2"
                      :tabindex="5" :disabled="form.processing"
                    >
                      <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                      Create account
                    </Button>
                </div>
    
                <div class="text-center text-sm text-muted-foreground">
                    Already have an account?
                    <TextLink :href="route('login')" class="text-red-600 hover:text-red-700 font-medium" :tabindex="6">Log in</TextLink>
                </div>
            </form>
        </div>
    </AuthBase>
</template>
