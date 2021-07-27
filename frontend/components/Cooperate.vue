<template>
  <div class="relative bg-indigo-400" id="cooperation">
    <div class="absolute inset-0">
      <img
        class="w-full h-full object-cover"
        src="https://images.unsplash.com/photo-1525130413817-d45c1d127c42?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1920&q=60&&sat=-100"
        alt=""
      />
      <div
        class="absolute inset-0 bg-indigo-400 mix-blend-multiply"
        aria-hidden="true"
      />
    </div>
    <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
      <h1
        class="
          text-3xl
          font-bold
          text-white
          sm:text-5xl
          3xl:text-5xl
          pl-6
          sm:pl-10
        "
      >
        Chcesz, aby studenci Twojej uczelni<br />
        skutecznie znajdowali praktyki?
      </h1>
      <p
        class="
          mt-6
          text-xl text-indigo-100
          lg:text-3xl
          max-w-5xl
          3xl:text-4xl
          pl-6
          sm:pl-10
        "
      >
        Skontaktuj się z nami! <br />
        {{ email }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "wspolpraca@znajdzpraktyki.pl",
    };
  },
};
</script>
