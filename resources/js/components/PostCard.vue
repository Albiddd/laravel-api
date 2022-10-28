<template>
  
    <article class="max-w-sm m-2 rounded overflow-hidden shadow-lg">
        <img class="w-full h-52 object-cover" v-if="post.cover" :src="`/storage/${post.cover}`" alt="">
        <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">{{ post.title }}</div>
        <p v-if="post.category" class="text-gray-700 text-base">
            {{ post.category.name }}
        </p>
    </div>
    <div class="px-6 pt-4 pb-2">
        <span class="inline-block bg-gray-200 cursor-default rounded-full px-3 py-1 text-sm font-semibold text-gray-700 hover:bg-indigo-300 hover:text-white mr-2 mb-2"
        v-for="tag in post.tags" :key="tag.id">
            {{ tag.name }}
        </span>
        <p class="text-sm">{{ post.date }}</p>
    </div>
</article>

</template>
  
  <script>
export default {
  props: {
    post: {
      type: Object,
      required: true,
    },
  },
};
</script>
  
  <style lang="scss" scoped>
</style>