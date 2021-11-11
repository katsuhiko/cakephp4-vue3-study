<template>
  <div v-if="loading">...loading</div>
  <div v-else-if="sample">
    <div v-for="item in sample" :key="item.id">
      title: {{ item.title }} content: {{ item.content }}
    </div>

    <input type="text" placeholder="title" v-model="title" />
    <input type="text" placeholder="content" v-model="content" />
    <button @click="addSample" :disabled="title === '' || content === ''">
      add
    </button>
  </div>
</template>

<script lang="ts">
import useSample from "@/api/composables/useSample";
import useSampleRegistration from "@/api/composables/useSampleRegistration";
import { defineComponent, ref } from "vue";

export default defineComponent({
  setup() {
    const { sample, loading, updateData } = useSample();

    const title = ref("");
    const content = ref("");

    return {
      sample,
      loading,
      title,
      content,
      addSample() {
        const { registered } = useSampleRegistration({
          content: content.value,
          title: title.value,
        });

        registered
          .then((id) => {
            updateData();
            alert(`登録しました。ID：${id}`);
          })
          .catch(() => {
            alert("登録に失敗しました。");
          });
      },
    };
  },
});
</script>
