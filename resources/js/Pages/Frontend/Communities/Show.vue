<template>
<guest-layout>
      <template #header>
      <div class="flex justify-between m-2 p-2">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          r/{{ community.name }}
        </h2>
        <Link
          v-if="$page.props.auth.auth_check"
          :href="route('communities.posts.create', community.slug)"
          class="px-3 py-2 rounded bg-indigo-500 hover:bg-indigo-300 text-white"
          >Create Post</Link
        >
      </div>
    </template>
  <div class="flex justify-end md-2 p-2">
   <Link 
   v-if="$page.props.auth.auth_check" 
   :href="route('communities.posts.create', community.slug)" 
   class="px-3 py-4 rounded bg-indigo-500">Create Post</Link>
  </div>
  <section class="m-2 p-2">
   <PostCard
          v-for="post in posts.data"
          :post = "post"
          :community = "community.name"
          :key="post.id"
        />
  </section>
</guest-layout>

</template>

<script setup>
import GuestLayout from "@/Layouts/Guest.vue"
import { Link } from "@inertiajs/inertia-vue3"
import PostCard from "@/Components/PostCard.vue";
defineProps({
    community: Object,
    posts: Object
})

</script>

