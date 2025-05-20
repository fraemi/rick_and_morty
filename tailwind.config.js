module.exports = {
  content: ["./symfony/templates/**/*.html.twig", "./assets/**/*.js"],
  theme: {
    extend: {},
  },
  plugins: [require("@tailwindcss/typography")],
};
