const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  content: ["./frontend/**/*.{vue,html}"],
  theme: {
    extend: {
      height:{
        'i': '94%',
      },
      fontFamily: {
        sans: ["Inter var", ...defaultTheme.fontFamily.sans],
      },
      colors: {
        'primary': '#171c58',
        'secondary': '#34375c',
           },
    },
  },
  variants: {
  },
  plugins: [
    require("@tailwindcss/forms"),
    require("@tailwindcss/typography"),
    require("@tailwindcss/aspect-ratio"),
    require("@tailwindcss/nesting"),
  ],
};
