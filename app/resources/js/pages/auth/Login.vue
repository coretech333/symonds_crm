<script setup lang="ts">
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <AuthBase>
        <Head title="Log in" />
          <div v-if="status" class="mb-4 text-center text-sm font-medium text-green-600">
              {{ status }}
          </div>
          
          <div class="bg-white rounded-3xl p-6 shadow-xl">
            <form @submit.prevent="submit" class="flex flex-col gap-6 space-y-4">
                <div class="grid gap-6">
                    <div class="grid gap-2">
                      <Label class="text-gray-700 text-md font-medium" for="email">Email address</Label>
                        <Input
                            id="email"
                            type="email"
                            required
                            autofocus
                            :tabindex="1"
                            autocomplete="email"
                            v-model="form.email"
                            placeholder="Enter your email"
                            class="h-[50px]"
                        />
                        <InputError :message="form.errors.email" />
                    </div>
                    <div class="grid gap-2">
                        <Label for="password" class="text-gray-700 text-md font-medium">Password</Label>
                        <Input
                            id="password"
                            type="password"
                            required
                            :tabindex="2"
                            autocomplete="current-password"
                            v-model="form.password"
                            placeholder="Password"
                            class="h-[50px]"
                        />
                        <InputError :message="form.errors.password" />
                    </div>
                    
                    <div class="flex items-center justify-between mt-2">
                      <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" v-model="form.remember" :tabindex="3" />
                        <span>Remember me</span>
                      </Label>
                      <TextLink v-if="canResetPassword" :href="route('password.request')" class="text-red-600 hover:text-red-700 text-sm font-medium" :tabindex="5">
                        Forgot password?
                      </TextLink>
                    </div>
                    <Button
                      type="submit"
                      class="w-full h-[50px] bg-gradient-to-r from-red-500 to-blue-600 text-white font-semibold py-2 px-4 rounded-xl hover:from-red-600 hover:to-blue-700 transition-all duration-200 mt-2"
                      :tabindex="4" :disabled="form.processing"
                    >
                      <LoaderCircle v-if="form.processing" class="h-4 w-4 animate-spin" />
                      Sign In
                    </Button>
                </div>
                <div class="text-center text-sm text-muted-foreground">
                    Don't have an account?
                    <TextLink :href="route('register')" :tabindex="5" class="text-red-600 hover:text-red-700 font-medium">Sign up</TextLink>
                </div>
            </form>
          </div>
    </AuthBase>
</template>
