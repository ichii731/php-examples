<template>
  <h1>{{ hello }}</h1>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";

export default defineComponent({
  name: "ExampleComponent",
  setup() {
    const hello = ref("Hello World!");
    return { hello };
  },
  mounted() {
    console.log("mounted!");
  },
});
</script>
