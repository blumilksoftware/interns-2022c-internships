<script setup>
const props = defineProps({
  company: Object,
});

const emit = defineEmits(["selectedCompany"]);
function onCompanySelect() {
  emit("selectedCompany", props.company.id);
}
</script>

<template>
  <div
    class="bg-white overflow-hidden shadow rounded-lg cursor-pointer"
    @click="onCompanySelect"
  >
    <div class="px-2 py-3 sm:p-2">
      <table>
        <tbody class="divide-y divide-gray-200 bg-white overflow-hidden py-5">
          <tr>
            <td class="whitespace-nowrap py-4 pl-1 pr-3 text-sm sm:pl-1">
              <div class="flex items-center">
                <div class="flex-shrink-0">
                  <div
                    class="h-12 w-12 sm:h-20 sm:w-20 shadow-lg rounded-lg border-2"
                  >
                    <img
                      class="object-contain h-full w-full"
                      :src="'/storage/images/' + company.logo"
                    />
                  </div>
                </div>
                <div class="ml-4">
                  <div class="font-medium text-md sm:text-lg max-w-sm text-ellipsis overflow-hidden ... text-gray-900">
                    {{ company.name }}
                  </div>
                  <div class="text-gray-500">
                    {{ company.location.shortName }}
                  </div>
                  <div class="flex flex-inline max-w-sm text-ellipsis overflow-hidden ...">
                    <div class="mt-2" v-if="company.status === 'pending_new'">
                      <span
                        class="bg-yellow-100 text-yellow-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-200 dark:text-yellow-800"
                      >
                        {{ $t("company_browser.is_pending") }}
                      </span>
                    </div>
                    <div class="mt-2" v-if="company.has_signed_papers">
                      <span
                        class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-800"
                      >
                        {{ $t("company_browser.has_signed_papers") }}
                      </span>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
