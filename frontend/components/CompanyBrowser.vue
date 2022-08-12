
<template>
    

    <!-- 3 column wrapper -->
    <div class="flex-col flex-grow w-full mx-0 flex md:flex-row-reverse flex-none" >
      <!-- Left sidebar & main wrapper -->
      <div class="flex-1 bg-white w-full">

        <!-- Projects List -->
        <div class="bg-white w-screen h-2/3 md:w-2/4">
            test
        </div>
      </div>
      <!-- Activity feed -->
      <div class="bg-gray-50 pr-4 sm:pr-6 lg:pr-8 lg:flex-shrink-0 lg:border-l lg:border-gray-200 xl:pr-0 w-screen md:w-1/3">
        <div class="pl-6 lg:w-80">
          <div class="pt-6 pb-2">
            <h2 class="text-sm font-semibold">Activity</h2>
          </div>
          <div>
            <ul role="list" class="divide-y divide-gray-200">
              <li v-for="item in activityItems" :key="item.commit" class="py-4">
                <div class="flex space-x-3">
                  <img class="h-6 w-6 rounded-full" src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=256&h=256&q=80" alt="" />
                  <div class="flex-1 space-y-1">
                    <div class="flex items-center justify-between">
                      <h3 class="text-sm font-medium">You</h3>
                      <p class="text-sm text-gray-500">{{ item.time }}</p>
                    </div>
                    <p class="text-sm text-gray-500">Deployed {{ item.project }} ({{ item.commit }} in master) to {{ item.environment }}</p>
                  </div>
                </div>
              </li>
            </ul>
            <div class="py-4 text-sm border-t border-gray-200">
              <a href="#" class="text-indigo-600 font-semibold hover:text-indigo-900">View all activity <span aria-hidden="true">&rarr;</span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import {
  BadgeCheckIcon,
  ChevronDownIcon,
  ChevronRightIcon,
  CollectionIcon,
  SearchIcon,
  SortAscendingIcon,
  StarIcon,
} from '@heroicons/vue/solid'
import { MenuAlt1Icon, XIcon } from '@heroicons/vue/outline'

const navigation = [
  { name: 'Dashboard', href: '#', current: true },
  { name: 'Domains', href: '#', current: false },
]
const userNavigation = [
  { name: 'Your Profile', href: '#' },
  { name: 'Settings', href: '#' },
  { name: 'Sign out', href: '#' },
]
const projects = [
  {
    name: 'Workcation',
    href: '#',
    siteHref: '#',
    repoHref: '#',
    repo: 'debbielewis/workcation',
    tech: 'Laravel',
    lastDeploy: '3h ago',
    location: 'United states',
    starred: true,
    active: true,
  },
  {
    name: 'Workcation',
    href: '#',
    siteHref: '#',
    repoHref: '#',
    repo: 'debbielewis/workcation',
    tech: 'Laravel',
    lastDeploy: '3h ago',
    location: 'United states',
    starred: true,
    active: true,
  },
  // More projects...
]
const activityItems = [
  { project: 'Workcation', commit: '2d89f0c8', environment: 'production', time: '1h' },
  // More items...
]
</script>