<script setup>
const props = defineProps({
  active: Number,
  created: Number,
  edited: Number,
});
</script>

<template>
  <div
    class="xl:m-auto my-10 mx-8 max-w-4xl px-0 sm:px-0 border-1 border-gray-700 shadow-md rounded-lg bg-white w-full lg:px-8"
  >
    <div class="mx-5 my-5 max-w-3xl text-lg font-bold">
      {{ $t("admin_panel.welcome") }} ! {{ $page.props.auth.user.full_name }}
      <div clas="flex justify center">
        <h1 class="text-center">{{ $t("admin_panel.grouped") }}</h1>
        <ul role="list" class="mt-3 flex flex-col">
          <li class="flex rounded-md shadow-sm my-3">
            <div
              class="bg-green-500 flex-shrink-0 flex items-center w-16 text-white text-sm font-medium rounded-l-md"
            ></div>
            <div
              class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white"
            >
              <div class="flex-1 truncate px-4 py-2 text-md">
                <InertiaLink
                  href="/admin/companies?status=verified"
                  class="font-medium text-gray-900 hover:text-gray-600"
                  >{{ $t("tree_selects.tree_select_active") }}</InertiaLink
                >
                {{ props.active }}
              </div>
            </div>
          </li>
          <li class="flex rounded-md shadow-sm my-3">
            <div
              class="bg-yellow-500 flex-shrink-0 flex items-center w-16 text-white text-sm font-medium rounded-l-md,"
            ></div>
            <div
              class="flex flex-1 items-center justify-between truncate rounded-r-md border-t border-r border-b border-gray-200 bg-white"
            >
              <div class="flex-1 truncate px-4 py-2 text-md">
                <InertiaLink
                  href="/admin/companies?status=pending_new"
                  class="font-medium text-gray-900 hover:text-gray-600"
                  >{{ $t("tree_selects.tree_select_new") }}</InertiaLink
                >
                {{ props.created }}
              </div>
            </div>
          </li>
        </ul>
        <div class="mx-5 mt-11 max-w-3xl text-md text-end">
          {{ $t("admin_panel.more_info") }}
        </div>
      </div>
    </div>
  </div>
</template>
