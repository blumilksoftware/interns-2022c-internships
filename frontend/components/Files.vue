<template>
  <div class="wrapper">
    <h1 class="title text-md lg:text-2xl 2xl:text-3xl">Pliki do pobrania</h1>
    <div class="flow-root mt-6" id="files">
      <ul class="-my-5 divide-y divide-gray-200">
        <li v-for="file in files" :key="file.id" class="py-4">
          <div class="flex items-center space-x-4">
            <div class="flex-1 min-w-0">
              <p
                class="
                  text-sm
                  font-medium
                  lg:text-xl
                  2xl:text-2xl
                  text-gray-900
                  truncate
                "
              >
                {{ file.displayedName }}
              </p>
            </div>
            <div>
              <a
                title="download file"
                class="
                  noselect
                  btn
                  inline-flex
                  items-center
                  shadow-sm
                  px-2.5
                  py-0.5
                  border border-gray-300
                  text-sm
                  leading-5
                  font-medium
                  rounded-full
                  text-gray-700
                  bg-white
                  hover:bg-gray-100
                  xl:text-xl
                "
              >
                Pobierz
              </a>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";
import api from "../api";
import { useRouter } from "vue-router";
export default {
  setup() {
    const router = useRouter();
    const files = ref([]);
    onMounted(() => {
      api.fetch(
        router,
        "faculties/wydzial-techniczny/documents/documents",
        (data) => {
          files.value = data;
        }
      );
    });
    return { files };
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  display: flex;
  flex-direction: column;
  .title {
    margin: 0 auto;
    font-family: Poppins;
  }
  .btn {
    cursor: pointer;
  }
}
</style>
