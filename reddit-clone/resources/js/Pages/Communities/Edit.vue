<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';


const props = defineProps( {

    community: Object,
    errors: Object
})


const form = useForm({
    name: props.community.name,
    description:  props.community.description,
    slug:  props.community.slug,
    //props.community
});

const submit = () => {
    form.put(route('communities.update', props.community.id));
};
</script>

<template>
    <Head title="Community Update" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Update Community
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
              <div class="max-w-md mx-auto bg-white m-2 p-2">   
                <form @submit.prevent="submit">
    <div>
        <InputLabel for="name" value="Name" />

        <TextInput
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            autofocus
            autocomplete="name"
        />

        <InputError class="mt-2" :message="form.errors.name" />
    </div>
    <!-- <div>
        <InputLabel for="slug" value="Slug" />

        <TextInput
            id="slug"
            type="text"
            class="mt-1 block w-full"
            v-model="form.slug"
       
            autocomplete="slug"
        />

        <InputError class="mt-2" :message="form.errors.name" />
    </div> -->

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
