<template>
  <div>
    <div class="fieldContainer">
      <ul role="list" class="divide-y divide-gray-500">
        <div class="flex items-center px-4 py-4 sm:px-6">
          <div class="min-w-0 flex-1 flex items-center">
            <div class="flex-shrink-0">
              <img
                class="h-20 w-20 border-2 rounded-md border-zinc-600"
                src="../assets/images/blumilklogo.png"
                alt=""
              />
            </div>
            <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-1 md:gap-4">
              <div>
                <p class="text-lg font-medium text-zinc-900 truncate">
                  {{ companyName }}
                </p>
                <p class="mt-2 flex items-center text-sm text-gray-900">
                  <img
                    src="../assets/icons/locationIcon.svg"
                    class="flex-shrink-0 mr-1.5 h-3 w-3 text-gray-400"
                    aria-hidden="false"
                  />
                  <span class="mr-1.5">{{ course }}</span>
                  <img
                    src="../assets/icons/locationIcon.svg"
                    class="flex-shrink-0 mr-1.5 h-3 w-3 text-gray-400"
                    aria-hidden="false"
                  />
                  <span class="mr-1.5">{{ location }}</span>
                </p>
              </div>
            </div>
          </div>
        </div>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    companyName: {
      type: String,
      required: true,
    },
    course: {
      type: String,
      required: true,
    },
    location: {
      type: String,
      required: true,
    },
  },
};
</script>
