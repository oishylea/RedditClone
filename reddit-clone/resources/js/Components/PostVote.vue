<template>
    <div class=" flex flex-col h-full w-12 p-2 bg-slate-200 text-center rounded-lg">
        <UpVoteLink 
            :slug="post.slug" 
            :class="{
                'text-blue-600': post.postVotes[0] && post.postVotes[0].vote == 1
            }"
        />
        <div class="p-2 my-2 font-bold"
            :class="{
                'text-blue-600': post.postVotes[0] && post.postVotes[0].vote == 1,
                'text-red-600': post.postVotes[0] && post.postVotes[0].vote == -1
            }"
        >
            {{ post.votes }}
        </div>
        <!-- <Link :href="route('posts.downVote', post)" 
        method="post" as="button" type="button"
            class="text-grey-400 hover:text-yellow-500"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
            </svg>
        </Link> -->
    </div>
</template>

<script setup>


import {Link} from "@inertiajs/inertia-vue3";
import UpVoteLink from "./UpVoteLink.vue";
defineProps({
    post: Object,
})
</script>

<style>
</style>