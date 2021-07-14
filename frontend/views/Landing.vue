<template>
  <div class="relative bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto">
      <div
        class="
          relative
          z-10
          pb-8
          bg-white
          sm:pb-16
          md:pb-20
          lg:max-w-2xl lg:w-full lg:pb-28
          xl:pb-32
        "
      >
        <svg
          class="
            hidden
            lg:block
            absolute
            right-0
            inset-y-0
            h-full
            w-48
            text-white
            transform
            translate-x-1/2
          "
          fill="currentColor"
          viewBox="0 0 100 100"
          preserveAspectRatio="none"
          aria-hidden="true"
        >
          <polygon points="50,0 100,0 50,100 0,100" />
        </svg>

        <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
          <nav
            class="
              relative
              flex
              items-center
              justify-between
              sm:h-10
              lg:justify-start
            "
            aria-label="Global"
          >
            <div
              class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0"
            >
              <div class="flex items-center justify-between w-full md:w-auto">
                <a href="#">
                  <p class="logo">{{ projectName }}</p>
                </a>
              </div>
            </div>
          </nav>
        </div>

        <main
          class="
            n
            mx-auto
            max-w-7xl
            px-4
            sm:mt-12 sm:px-6
            md:mt-16
            lg:mt-20 lg:px-8
            xl:mt-28
          "
        >
          <div class="sm:text-center lg:text-left">
            <h1
              class="
                text-4xl
                tracking-tight
                font-extrabold
                text-gray-900
                sm:text-5xl
                md:text-6xl
              "
            >
              <span class="block xl:inline">Zdobądź doświadczenie z</span>
              {{ " " }}
              <span class="block text-indigo-500 m:inline">{{
                university
              }}</span>
            </h1>
            <p
              class="
                mt-3
                text-base text-gray-500
                sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto
                md:mt-5 md:text-xl
                lg:mx-0
              "
            >
              Wybierz wydział na którym studiujesz i znajdź wymarzonych
              praktykodawców.
            </p>
            <div
              class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start"
            >
              <div class="rounded-md shadow">
                <div>
                  <select
                    id="department"
                    name="Wydział"
                    class="
                      mt-1
                      block
                      w-full
                      pl-3
                      pr-10
                      py-2
                      text-base
                      border-gray-300
                      focus:outline-none
                      focus:ring-indigo-500
                      focus:border-indigo-500
                      sm:text-sm
                      rounded-md
                    "
                  >
                    <option selected="">Wydział Informatyki</option>
                    <option>Wydział Grafiki</option>
                    <option>Wydział Gier Komputerowych</option>
                  </select>
                </div>
              </div>
              <div class="mt-3 sm:mt-0 sm:ml-3">
                <router-link
                  to="/home"
                  tag="button"
                  class="
                    inline-flex
                    items-center
                    px-4
                    py-2
                    border border-transparent
                    text-base
                    font-medium
                    rounded-md
                    shadow-sm
                    text-white
                    bg-indigo-500
                    hover:bg-indigo-500
                    focus:outline-none
                    focus:ring-2
                    focus:ring-offset-2
                    focus:ring-indigo-500
                  "
                >
                  Szukaj
                </router-link>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>
    <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
      <img
        class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
        src="https://images.unsplash.com/photo-1566647387313-9fda80664848?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2602&q=80"
        alt=""
      />
    </div>
  </div>

  <div class="relative bg-white">
    <div
      class="
        h-56
        bg-indigo-500
        sm:h-72
        lg:absolute lg:left-0 lg:h-full lg:w-1/2
      "
    >
      <img
        class="w-full h-full object-cover"
        src="https://images.unsplash.com/photo-1551434678-e076c223a692?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=2550&q=80"
        alt="Support team"
      />
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-8 sm:py-12 sm:px-6 lg:py-16">
      <div
        class="
          max-w-2xl
          mx-auto
          lg:max-w-none lg:mr-0 lg:ml-auto lg:w-1/2 lg:pl-10
          mb-8
        "
      >
        <h2
          class="
            mt-6
            text-3xl
            font-extrabold
            text-left text-gray-900
            sm:text-4xl
          "
        >
          Reprezentujesz szkołę? <br />
          <span class="block text-indigo-500 m:inline">Dołącz do nas!</span>
        </h2>
        <p class="mt-6 text-lg text-left text-gray-500">
          Dzięki {{ projectName }} Twoja uczelnia uzyska dostęp do przyjaznego
          studentom interfejsu z wieloma funkcjami ułatiwającymi znalezienie
          odpowiedniego praktykodawcy. Jest to projekt open source - każdy może
          skorzystać w pełni za darmo.
        </p>
        <router-link
          to="/home"
          tag="button"
          class="
            inline-flex
            items-center
            px-4
            py-2
            border border-transparent
            text-base
            font-medium
            rounded-md
            shadow-sm
            text-white
            bg-indigo-500
            hover:bg-indigo-500
            focus:outline-none
            focus:ring-2
            focus:ring-offset-2
            focus:ring-indigo-500
            mt-8
          "
        >
          Sprawdź jak!
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      projectName: "Znajdź Praktyki",
      university: "PWSZ Legnica",
    };
  },
};
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");
.logo {
  font-family: Poppins;
  font-size: 24px;
  font-weight: 700;
}

.maxheight {
  height: 50vh;
}
</style>
