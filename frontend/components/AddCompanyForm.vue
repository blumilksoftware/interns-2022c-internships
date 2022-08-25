<template>
  <form class="space-y-8 divide-y divide-gray-200 mx-auto mt-3" action="#" method="POST">
    <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
      <div>
        <div >
          <h3 class="flex justify-center text-lg leading-6 font-medium text-gray-900">Company add request</h3>
          <p class="flex justify-center mt-1 max-w-2xl text-sm text-gray-500">After filling up the form, your request will be send to moderator, where will be verify.</p>
          <p class="flex justify-center mt-1 max-w-2xl text-sm text-gray-500">You will be noticed by email after proccess.</p>
        </div>
        <div class="mt-6 sm:mt-5 space-y-6 sm:space-y-5">
          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="username" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Company Name </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <div class="max-w-lg flex rounded-md shadow-sm">
                <input type="text" name="username" id="username" autocomplete="username" class="flex-1 block w-full focus:ring-primary focus:border-primary min-w-0 rounded-none rounded-r-md sm:text-sm border-gray-300" />
              </div>
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="description" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Description </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <textarea id="description" name="description" rows="3" class="max-w-lg shadow-sm block w-full focus:ring-primary focus:border-primary sm:text-sm border border-gray-300 rounded-md" />
              <p class="mt-2 text-sm text-gray-500">Write about your company to help students with decision.</p>
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-center sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="photo" class="block text-sm font-medium text-gray-700"> Logo </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <div class="flex items-center">
                <span class="h-10 w-10 rounded-full overflow-hidden bg-gray-100">
                  <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
                </span>
                <button type="button" class="ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">Change</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="pt-2 space-y-6 sm:pt-2 sm:space-y-5">
          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:pt-5">
            <label for="country" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Country </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <select id="country" name="country" autocomplete="country-name" class="max-w-lg block focus:ring-primary focus:border-primary w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                <option>Poland</option>
                   <option>Other country</option>
                      <option>Other country</option>
                         <option>Other country</option>
                            <option>Other country</option>
              </select>
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="street-address" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Street address </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="block max-w-lg w-full shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md" />
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="city" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> City </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <input type="text" name="city" id="city" autocomplete="address-level2" class="max-w-lg block w-full shadow-sm focus:ring-primary focus:border-primary sm:max-w-xs sm:text-sm border-gray-300 rounded-md" />
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="region" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Voivodeship </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <input type="text" name="region" id="region" autocomplete="address-level1" class="max-w-lg block w-full shadow-sm focus:ring-primary focus:border-primary sm:max-w-xs sm:text-sm border-gray-300 rounded-md" />
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
            <label for="postal-code" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2"> Postal code </label>
            <div class="mt-1 sm:mt-0 sm:col-span-2">
              <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="max-w-lg block w-full shadow-sm focus:ring-primary focus:border-primary sm:max-w-xs sm:text-sm border-gray-300 rounded-md" />
            </div>
          </div>
        </div>
      </div>
    <div class="pt-5">
      <div class="flex justify-end">
        <button type="button" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">Cancel</button>
        <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">Request</button>
      </div>
    </div>
  </form>
</template>
