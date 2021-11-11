import { Sample } from "@/model/Sample";
import { ref } from "vue";
import { getSample } from "../sample";

export default function () {
  const sample = ref<Sample[]>();
  const loading = ref(false);

  async function updateData() {
    try {
      loading.value = true;

      const res = await getSample();

      switch (res.status) {
        case 200:
          sample.value = res.data.data;

          break;
        case 404:
          break;
        default: {
          res;
        }
      }
    } catch (error) {
      console.error(error);
    } finally {
      loading.value = false;
    }
  }

  updateData();

  return { sample, loading, updateData };
}
