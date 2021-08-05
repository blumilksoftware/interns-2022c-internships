<template>
  <div
    class="
      relative
      bg-gray-50
      pt-16
      pb-20
      px-4
      sm:px-6
      lg:pt-24 lg:pb-28 lg:px-8
    "
  >
    <div class="absolute inset-0">
      <div class="bg-white h-1/3 sm:h-2/3" />
    </div>
    <div class="relative max-w-7xl mx-auto">
      <div class="text-center">
        <h2
          class="
            text-3xl
            tracking-tight
            font-extrabold
            text-indigo-500
            sm:text-4xl
          "
        >
          Oni znaleźli swoje praktyki
        </h2>
        <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
          Dzięki naszej wyszukiwarce studenci znajdują dopasowane praktyki o
          wiele szybciej i skuteczniej. Przeczytaj historie tych, którzy już
          znaleźli.
        </p>
      </div>
      <div
        class="mt-12 max-w-lg mx-auto grid gap-5 lg:grid-cols-3 lg:max-w-none"
      >
        <div
          v-for="post in posts"
          :key="post.title"
          class="flex flex-col rounded-lg shadow-lg overflow-hidden"
        >
          <div class="flex-shrink-0">
            <img
              class="h-48 w-full object-cover"
              :src="post.imageUrl"
              alt="Internship participant"
            />
          </div>
          <div class="flex-1 bg-white p-6 flex flex-col justify-between">
            <div class="flex-1">
              <p class="text-sm font-medium text-indigo-600">
                <a class="hover:underline">
                  {{ post.category.name }}
                </a>
              </p>
              <a :href="post.href" class="block mt-2">
                <p class="text-xl font-semibold text-gray-900">
                  {{ post.title }}
                </p>
                <p class="mt-3 text-base text-gray-500">
                  {{ post.description }}
                </p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const posts = [
  {
    title: "Zdobyłem masę doświadczenia",
    href: "#",
    category: { name: "Informatyka" },
    description:
      "Znalazłem praktykodawce, w świetnym software house i muszę przyznać, że nigdy w tak krótkim czasie nie nauczyłem się tak wielu rzeczy. W dodatku dzięki filtrom i tagom mogłem idealnie dopasować swoje umiejętności - które mocno rozwinąłem.",
    imageUrl:
      "https://images.unsplash.com/photo-1563986768817-257bf91c5753?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1085&q=80",
  },
  {
    title: "Nauczyłam się pracy w drużynie",
    href: "#",
    category: { name: "Grafika" },
    description:
      "Dużo wiedzy, praca w zespole, nowe spojrzenie na to jak wygląda praca komercyjna to tylko niektóre z plusów moich praktyk. Dzięki mapce znalazłam praktykodawce po sąsiedzku i jestem bardzo zadowolona.",
    imageUrl:
      "https://images.unsplash.com/photo-1485217988980-11786ced9454?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80",
  },
  {
    title: "Próbna wersja przyszłej pracy",
    href: "#",
    category: { name: "Administracja" },
    description:
      "Studiuję administrację i chciałbym w przyszłości pracować w urzędzie. Dzięki Znajdź Praktyki okazało się, że nie muszę jeździć do miasta, tylko mogę odbywać praktyki w okolicznym urzędzie gminy. Było to dla mnie doświadczenie przyszłej pracy w skali makro, z którego mnóstwo wyniosłem.",
    imageUrl:
      "https://images.unsplash.com/photo-1511551203524-9a24350a5771?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80",
  },
];

export default {
  setup() {
    return {
      posts,
    };
  },
};
</script>
