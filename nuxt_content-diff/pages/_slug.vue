<template>
<div class="news">
  <article class="content">
    <h2>{{ article.title }}</h2>
    <p>{{ article.description }}</p>
    <p>last update: {{ formatDate(article.createdAt) }}</p>
    <nuxt-content :document="article"></nuxt-content>
  </article>
</div>
</template>

<script>
export default {
  methods: {
    formatDate(date) {
      const options = { year: 'numeric', month: 'long', day: 'numeric' }
      return new Date(date).toLocaleDateString('ja', options)
    }
 },
  async asyncData({ $content, params }) {
    // Sort & Get
    const article = await $content('articles', params.slug).fetch()
    return { article }
  },
};
</script>
