<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

// Watson Assistant Chat Script
const loadWatsonChat = () => {
    window.watsonAssistantChatOptions = {
        integrationID: "82c61e74-2a53-4ddd-adf7-3892109681aa", // The ID of this integration.
        region: "aws-us-east-1", // The region your integration is hosted in.
        serviceInstanceID: "20241023-1329-4572-60ab-60dd94794a27", // The ID of your service instance.
        onLoad: async (instance) => { await instance.render(); }
    };
    
    setTimeout(function() {
        const t = document.createElement('script');
        t.src = "https://web-chat.global.assistant.watson.appdomain.cloud/versions/" + (window.watsonAssistantChatOptions.clientVersion || 'latest') + "/WatsonAssistantChatEntry.js";
        document.head.appendChild(t);
    });
};

// Call the function to load the chat
loadWatsonChat();
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>