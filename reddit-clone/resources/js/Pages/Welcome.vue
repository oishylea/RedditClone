<template>
    <guest-layout>
       <section class="flex md:flex-row m-2 p-2">
            <div class="w-8/12">
                <PostCard 
                v-for="post in posts.data" 
                :post="post" 
                :community="post.community_slug" 
                :key="post.id" 
                />
            </div>
            <div class="w-4/12 p-4">
                    <CommunityList :communities="communities.data">
                        <template #title>Top communities</template>
                    </CommunityList>
                </div>
        </section> 
    </guest-layout>
</template>

<script setup>
import GuestLayout from "@/Layouts/Guest.vue";
import PostCard from "@/Components/PostCard.vue"; // Adjust the path based on your project structure
import Pagination from "@/Components/Pagination.vue";

defineProps({
        communities: Object,
        posts: Object, 
});

</script>