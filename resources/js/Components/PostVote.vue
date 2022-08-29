<template>
  <div class="w-12 flex flex-col m-2 p-2">
     <UpVoteLink :slug="post.slug" :class="{'text-blue-600': post.postVotes[0] && post.postVotes[0].vote == 1}"/>
    <div class="p-2 my-2 bg-blue-300 rounded-md">{{ post.votes }}</div>
     <DownVoteLink :slug="post.slug" :class="{'text-red-600': post.postVotes[0] && post.postVotes[0].vote == -1}" />
  </div>
</template>

<script setup>
import UpVoteLink from './UpVoteLink.vue'
import DownVoteLink from './DownVoteLink.vue'
import { Link } from "@inertiajs/inertia-vue3"

defineProps({
    post: Object
})
</script>

<style>
</style>