<template>
<div class="news-top">
  <div class="news-list">
    <ul>
      <li v-for="article in article" :key="article.slug">
        <nuxt-link :to="'/' + article.slug">
          <p>{{ article.title }} / {{ formatDate(article.createdAt)}}</p>
        </nuxt-link>
      </li>
    </ul>
  </div>
</div>
</template>

<script>
export default {
  methods: {
    formatDate(date) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      return new Date(date).toLocaleDateString("ja", options);
    },
  },
  async asyncData({ $content }) {
    const article = await $content("articles")
      .limit(2)
      .sortBy("createdAt", "desc")
      .fetch();
    return {
      article,
    };
  },
};
</script>
