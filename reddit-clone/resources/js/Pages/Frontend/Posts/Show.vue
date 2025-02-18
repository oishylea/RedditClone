<template>
    <guest-layout>
      <section class="flex flex-col md:flex-row m-2 p-2">
        <div class="w-full md:w-8/12">
          <div class="mx-2 p-2 bg-white rounded-lg">
            <h2 class="font-semibold text-2xl text-black">
              <Link :href="route('frontend.communities.show', community.slug)">
                r/{{ community.name }}
              </Link>
            </h2>
          </div>
          <div class="flex m-2 p-2 bg-white rounded-lg text-sm text-slate-400">
            <div>
              <PostVoteLink :post="post.data" />
            </div>
              <div>V0tes</div>
              <div class="w-full">
                <div class="flex flex-col md:flex-row justify-between m-2">
              <div>
                Posted by
                <span class="ml-2 text-slate-700">{{ post.data.username }}</span>
              </div>
              <div v-if="post.data.owner">
                <Link
                  :href="route('communities.posts.edit', [community.slug, post.data.slug])"
                  class="font-semibold bg-blue-500 hover:bg-blue-700 rounded-md text-white px-4 py-2 mr-2"
                  >Edit</Link
                >
                <Link
                  :href="route('communities.posts.destroy', [community.slug, post.data.slug])"
                  class="font-semibold bg-red-500 hover:bg-red-700 rounded-md text-white px-4 py-2"
                  method="delete"
                  as="button"
                  type="button"
                  >Delete</Link
                >
              </div>
            </div>
            <div class="p-2">
              <h1 class="font-semibold text-3xl text-black">{{ post.data.title }}</h1>
              <p class="text-slate-700 my-2">{{ post.data.description }}</p>
              <a
                :href="post.data.url"
                class="font-semibold text-blue-500 text-sm hover:text-blue-300"
                >{{ post.data.url }}</a
              >
            </div> 
            <hr />
            <ul>
              <li
                v-for="(comment, index) in post.data.comments"
                :key="comment.id" 
                class="py-4 flex flex-col"
              >
                <div class="text-sm">
                  Commented by
                  <span class="font-semibold ml-1 text-slate-700">{{ comment.username }}</span>
                </div>
                <div class="text-slate-600 m-2 p-2">
                  {{ comment.content }}
                </div>
              </li>
            </ul>
            <hr />
  
            <div v-if="$page.props.auth.auth_check">
              <form class="bg-white shadow-md rounded-lg p-6 my-4" @submit.prevent="submit">
                <div class="mb-4">
                  <label for="comment" class="block text-gray-700 font-bold mb-2">Your comment</label>
                  <textarea
                    v-model="form.content"
                    id="comment"
                    rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-black"
                  ></textarea>
                </div>
                <div class="flex justify-end">
                  <button
                    type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                  >
                    Comment
                  </button>
                </div>
              </form>
            </div>
              </div>
            </div>
          </div>
        <div class="w-full md:w-4/12 p-4">
          <PostList :posts="posts.data" :community="community">
          <template #title>Popular Posts</template>
        </PostList>
        </div>
      </section>
    </guest-layout>
  </template>
  
  <script setup>
  import GuestLayout from "@/Layouts/Guest.vue";
  import { Link, useForm } from "@inertiajs/inertia-vue3"; // Import useForm
  import PostVote from "@/Components/PostVote.vue"; // Ensure the path is correct

  const props = defineProps({
    community: Object,
    post: Object,
    posts: Object,
  });
  
  const form = useForm({
    content: "",
  });
  
  const submit = () => {
  console.log('Form data before submission:', form); // Debugging log
  form.post(route('frontend.posts.comments', [props.community.slug, props.post.data.slug]), {
    onSuccess: (response) => {
      console.log('Form submitted successfully!', response); // Success log
      
      const newComment = {
        id: response.comment.id, // Ensure this exists in your response
        content: form.content,
        username: $page.props.auth.user.username, // Ensure this is correct
        created_at: new Date().toISOString(), // Optional: format as needed
      };
      
      props.post.data.comments.push(newComment);
      form.reset(); // Clear the form after successful submission
    },
    onError: (errors) => {
      console.error('Form submission errors:', errors); // Error log
    },
  });
};
  </script>