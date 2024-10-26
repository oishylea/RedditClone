<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    post: Object,
    community: Object,
    errors: Object
});

const form = useForm({
    title: props.post?.title,
    description: props.post?.description,
    url: props.post?.url,
});

const submit = () => {
    console.log('Form data before submission:', form); // Debugging log
    form.put(route('communities.posts.update', [props.community.slug, props.post.slug]), {
        onSuccess: () => {
            console.log('Form submitted successfully!'); // Success log
        },
        onError: (errors) => {
            console.error('Form submission errors:', errors); // Error log
        },
    });
};
</script>

<template>
    <Head title="Create Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Post for {{ community.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="max-w-md mx-auto bg-white m-2 p-2">
                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="title" value="Title" />
                            <TextInput
                                id="title"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.title"
                                autofocus
                                autocomplete="title"
                            />
                            <InputError class="mt-2" :message="form.errors.title" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="url" value="URL" />
                            <TextInput
                                id="url"
                                type="url"
                                class="mt-1 block w-full"
                                v-model="form.url"
                                autocomplete="url"
                            />
                            <InputError class="mt-2" :message="form.errors.url" />
                        </div>

                        <div class="mt-4">
                            <InputLabel for="description" value="Description" />
                            <TextInput
                                id="description"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.description"
                                autocomplete="description"
                            />
                            <InputError class="mt-2" :message="form.errors.description" />
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <PrimaryButton
                                class="ms-4"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Update
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>