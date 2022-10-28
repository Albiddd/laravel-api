<template>
  <section>
    <h1>{{ title }}</h1>
    <div class="container mx-auto grid grid-cols-4">
      <post-card v-for="post in posts" :key="post.id" :post="post"></post-card>
    </div>
    <div class="container mx-auto pt-12">
      <ul class="flex gap-6 justify-center font-semibold">
        <li v-if="currentPage !== 1" @click="fetchPosts(1)" 
        :class="{ 'w-8 h-8 flex items-center justify-center rounded-full' : true,
          'bg-gray-100 cursor-pointer hover:bg-indigo-300' : true
          }">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
            <path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
          </svg>  
          </li>

        <li @click="fetchPosts(page)" 
        :class="{ 'w-8 h-8 flex items-center justify-center rounded-full' : true,
          'bg-indigo-300 text-white' : page === currentPage,
          'bg-gray-100 cursor-pointer hover:bg-indigo-300 hover:text-white' : true
          }"
        v-for="page in lastPage" :key="page">{{page}}</li>

        <li v-if="currentPage !== lastPage" @click="fetchPosts(lastPage)" 
        :class="{ 'w-8 h-8 flex items-center justify-center rounded-full' : true,
          'bg-gray-100 cursor-pointer hover:bg-indigo-300' : true
          }"> 
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/>
            <path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/>
          </svg>
          </li>
      </ul>
    </div>
  </section>
</template>

<script>
import PostCard from '../components/PostCard.vue';

export default {
    data() {
        return {
            title: "POSTS JS",
            posts: [],
            currentPage: 1,
            lastPage: 0,
            total: 0
        };
    },
    methods: {
        fetchPosts(page = 1) {
            axios.get('/api/posts',{
              params:{
                page: page
              }
            }).then((res) => {  
            console.log(res.data);
            const { data, current_page, last_page, total } = res.data.result
            this.posts = data
            this.lastPage = last_page
            this.currentPage = current_page
            this.total =  total
            });
        }
    },
    beforeMount() {
        this.fetchPosts();
    },
    components: { PostCard }
};
</script>

<style lang="scss" scoped>

</style>