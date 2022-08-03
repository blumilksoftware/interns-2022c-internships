<template>
  <div class="relative bg-white sections">
    <div
      class="h-56 bg-indigo-500 sm:h-72 lg:absolute lg:left-0 lg:h-full lg:w-1/2"
    >
      <svg
        class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2"
        fill="currentColor"
        viewBox="0 0 100 100"
        preserveAspectRatio="none"
        aria-hidden="true"
      >
        <polygon points="50,0 100,0 50,100 0,100" />
      </svg>
      <img
        class="w-full h-full object-cover"
        src="../assets/images/landing_left.jpg"
        alt="Software Developers at work"
      />
    </div>
    <div class="relative max-w-7xl mx-auto px-4 py-8 sm:py-12 sm:px-6 lg:py-16">
      <div
        class="max-w-2xl mx-auto lg:max-w-none lg:mr-0 lg:ml-auto lg:w-1/2 lg:pl-10 mb-8"
      >
        <h2
          class="mt-6 text-3xl font-extrabold text-left text-gray-900 sm:text-4xl"
        >
          Reprezentujesz szkołę? <br />
          <span class="block text-indigo-500 m:inline">Dołącz do nas!</span>
        </h2>
        <p class="mt-6 text-lg text-left text-gray-500">
          Dzięki Znajdź Praktyki Twoja uczelnia uzyska dostęp do przyjaznego
          studentom interfejsu z wieloma funkcjami ułatiwającymi znalezienie
          odpowiedniego praktykodawcy. Jest to projekt open source - każdy może
          skorzystać w pełni za darmo.
        </p>
        <router-link
          to="/home"
          tag="button"
          title="Cooperation"
          class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-500 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mt-8"
        >
          Sprawdź jak!
        </router-link>
      </div>
    </div>
  </div>
</template>
