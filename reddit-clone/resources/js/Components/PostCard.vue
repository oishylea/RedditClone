<template>
  <div class="
      mt-4 
      max-w-4xl 
      flex 
      bg-white 
      rounded-lg 
      border border-gray-200 
      shadow-md 
      dark:bg-white 
    ">
    <div class="mr-3">
      <PostVote :post="post" />
    </div>
    <div>
      <div class="flex m-2 p-2">
        <Link :href="route('frontend.communities.show', community)" class="font-semibold mr-3 hover:text-indigo-700">
        r/{{ community }}</Link>
        <div class="flex">
          Posted by
          <span class="font-semibold ml-1">{{ post.username }}</span>
        </div>
      </div>

      <Link :href="route('frontend.communities.posts.show', [community, post.slug])">
      <h5 class="
        mb-2 
        text-2xl 
        font-bold 
        tracking-tight 
        text-gray-900
        dark:text-black
        hover:text-indigo-700
      ">
        {{ post.title }}
      </h5>
      </Link>

      <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
        {{ post.description }}
      </p>

      <div class="flex m-2 p-2">
        <p class="mr-4 p-2">Comments({{ post.comments_count }})</p>
        <Link :href="route('frontend.communities.posts.show', [community, post.slug])"
          class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700">
        Read more
        <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
          xmlns="http://www.w3.org/2000/svg">s
        </svg>
        </Link>
      </div>
    </div>
  </div>

</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import PostVote from "./PostVote.vue";


defineProps({
  post: Object,
  community: String,
})

</script>

<style></style>