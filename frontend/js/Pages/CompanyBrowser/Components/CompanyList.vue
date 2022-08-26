<template>
  <div
    class="shadow ring-1 ring-black ring-opacity-5 md:rounded-lg overflow-x-hidden overflow-y-scroll"
  >
    <div class="mb-1" v-for="company in companies" :key="company.id">
      <CompanyTile
        :name="company.name"
        :email="company.email"
        :image="company.image"
        :description="company.description"
      />
    </div>
  </div>
</template>

<script setup>
import PlaceholderImage from "@/assets/images/blumilklogo.png";
import CompanyTile from "./CompanyTile.vue";

const companies = [
  {
    id: "1",
    name: "Some Company",
    email: "some.company@example.com",
    image: PlaceholderImage,
    description:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat nisi vitae tortor accumsan, ac maximus leo elementum. Praesent vestibulum dapibus eros at vestibulum. Fusce ut neque velit. Proin pharetra dui sit amet magna eleifend mattis. Nunc eget tortor vitae arcu condimentum rutrum. Sed molestie est justo, nec placerat purus pharetra nec. Morbi interdum elementum dignissim. Mauris eleifend pellentesque ligula quis faucibus. Suspendisse sit amet sodales risus, sit amet gravida est. Vivamus ac pharetra eros. Mauris nisi justo, semper quis libero id, tincidunt maximus nisi. Nullam cursus tempus orci eget rhoncus. Praesent elementum pretium purus, eget dictum magna porttitor quis. Suspendisse ac commodo risus. Praesent non ullamcorper massa, sit amet pellentesque augue.",
  },
  {
    id: "2",
    name: "Some Company",
    email: "some.company@example.com",
    image: PlaceholderImage,
    description:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat nisi vitae tortor accumsan, ac maximus leo elementum. Praesent vestibulum dapibus eros at vestibulum. Fusce ut neque velit. Proin pharetra dui sit amet magna eleifend mattis. Nunc eget tortor vitae arcu condimentum rutrum. Sed molestie est justo, nec placerat purus pharetra nec. Morbi interdum elementum dignissim. Mauris eleifend pellentesque ligula quis faucibus. Suspendisse sit amet sodales risus, sit amet gravida est. Vivamus ac pharetra eros. Mauris nisi justo, semper quis libero id, tincidunt maximus nisi. Nullam cursus tempus orci eget rhoncus. Praesent elementum pretium purus, eget dictum magna porttitor quis. Suspendisse ac commodo risus. Praesent non ullamcorper massa, sit amet pellentesque augue.",
  },
  {
    id: "3",
    name: "Some Company",
    email: "some.company@example.com",
    image: PlaceholderImage,
    description:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat nisi vitae tortor accumsan, ac maximus leo elementum. Praesent vestibulum dapibus eros at vestibulum. Fusce ut neque velit. Proin pharetra dui sit amet magna eleifend mattis. Nunc eget tortor vitae arcu condimentum rutrum. Sed molestie est justo, nec placerat purus pharetra nec. Morbi interdum elementum dignissim. Mauris eleifend pellentesque ligula quis faucibus. Suspendisse sit amet sodales risus, sit amet gravida est. Vivamus ac pharetra eros. Mauris nisi justo, semper quis libero id, tincidunt maximus nisi. Nullam cursus tempus orci eget rhoncus. Praesent elementum pretium purus, eget dictum magna porttitor quis. Suspendisse ac commodo risus. Praesent non ullamcorper massa, sit amet pellentesque augue.",
  },
  {
    id: "4",
    name: "Some Company",
    email: "some.company@example.com",
    image: PlaceholderImage,
    description:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat nisi vitae tortor accumsan, ac maximus leo elementum. Praesent vestibulum dapibus eros at vestibulum. Fusce ut neque velit. Proin pharetra dui sit amet magna eleifend mattis. Nunc eget tortor vitae arcu condimentum rutrum. Sed molestie est justo, nec placerat purus pharetra nec. Morbi interdum elementum dignissim. Mauris eleifend pellentesque ligula quis faucibus. Suspendisse sit amet sodales risus, sit amet gravida est. Vivamus ac pharetra eros. Mauris nisi justo, semper quis libero id, tincidunt maximus nisi. Nullam cursus tempus orci eget rhoncus. Praesent elementum pretium purus, eget dictum magna porttitor quis. Suspendisse ac commodo risus. Praesent non ullamcorper massa, sit amet pellentesque augue.",
  },
  {
    id: "5",
    name: "Some Company",
    email: "some.company@example.com",
    image: PlaceholderImage,
    description:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat nisi vitae tortor accumsan, ac maximus leo elementum. Praesent vestibulum dapibus eros at vestibulum. Fusce ut neque velit. Proin pharetra dui sit amet magna eleifend mattis. Nunc eget tortor vitae arcu condimentum rutrum. Sed molestie est justo, nec placerat purus pharetra nec. Morbi interdum elementum dignissim. Mauris eleifend pellentesque ligula quis faucibus. Suspendisse sit amet sodales risus, sit amet gravida est. Vivamus ac pharetra eros. Mauris nisi justo, semper quis libero id, tincidunt maximus nisi. Nullam cursus tempus orci eget rhoncus. Praesent elementum pretium purus, eget dictum magna porttitor quis. Suspendisse ac commodo risus. Praesent non ullamcorper massa, sit amet pellentesque augue.",
  },
  {
    id: "6",
    name: "Some Company",
    email: "some.company@example.com",
    image: PlaceholderImage,
    description:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat nisi vitae tortor accumsan, ac maximus leo elementum. Praesent vestibulum dapibus eros at vestibulum. Fusce ut neque velit. Proin pharetra dui sit amet magna eleifend mattis. Nunc eget tortor vitae arcu condimentum rutrum. Sed molestie est justo, nec placerat purus pharetra nec. Morbi interdum elementum dignissim. Mauris eleifend pellentesque ligula quis faucibus. Suspendisse sit amet sodales risus, sit amet gravida est. Vivamus ac pharetra eros. Mauris nisi justo, semper quis libero id, tincidunt maximus nisi. Nullam cursus tempus orci eget rhoncus. Praesent elementum pretium purus, eget dictum magna porttitor quis. Suspendisse ac commodo risus. Praesent non ullamcorper massa, sit amet pellentesque augue.",
  },
  {
    id: "7",
    name: "Some Company",
    email: "some.company@example.com",
    image: PlaceholderImage,
    description:
      "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam consequat nisi vitae tortor accumsan, ac maximus leo elementum. Praesent vestibulum dapibus eros at vestibulum. Fusce ut neque velit. Proin pharetra dui sit amet magna eleifend mattis. Nunc eget tortor vitae arcu condimentum rutrum. Sed molestie est justo, nec placerat purus pharetra nec. Morbi interdum elementum dignissim. Mauris eleifend pellentesque ligula quis faucibus. Suspendisse sit amet sodales risus, sit amet gravida est. Vivamus ac pharetra eros. Mauris nisi justo, semper quis libero id, tincidunt maximus nisi. Nullam cursus tempus orci eget rhoncus. Praesent elementum pretium purus, eget dictum magna porttitor quis. Suspendisse ac commodo risus. Praesent non ullamcorper massa, sit amet pellentesque augue.",
  },
];
</script>
