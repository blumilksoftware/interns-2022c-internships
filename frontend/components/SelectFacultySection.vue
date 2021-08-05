<template>
  <div class="relative bg-white overflow-hidden sections">
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
                  <p class="logo" title="Project logo">Znajdź Praktyki</p>
                </a>
              </div>
            </div>
          </nav>
        </div>

        <main
          class="
            mt-10
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
              <span class="block text-indigo-500 m:inline">PWSZ Legnica</span>
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
                  title="home"
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
    <div class="hidden lg:block lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
      <img
        class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full"
        src="../assets/images/landing_right.jpg"
        alt="Developer workstation with laptop desktop computer monitor connected"
      />
    </div>
  </div>
</template>

<style lang="scss" scoped>
.logo {
  font-family: Poppins;
  font-size: 24px;
  font-weight: 700;
}
</style>
