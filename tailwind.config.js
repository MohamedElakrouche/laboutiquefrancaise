/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./templates/**/*.html", "./static/**/*.js"], // Adapté à Symfony
  theme: {
    extend: {
      colors: {
        primary: "#1E40AF", // Exemple de couleur personnalisée
        secondary: "#FACC15",
      },
      animation: {
        bounceSlow: "bounce 3s infinite",
        fadeIn: "fadeIn 2s ease-in-out",
      },
      keyframes: {
        fadeIn: {
          "0%": { opacity: 0 },
          "100%": { opacity: 1 },
        },
      },
    },
  },
  plugins: [
    require("daisyui"), // Intégration de DaisyUI
  ],
  daisyui: {
    themes: [
      "light", // Thèmes par défaut de DaisyUI
      "dark",
      {
        myCustomTheme: { // Thème personnalisé
          primary: "#1E40AF",
          secondary: "#FACC15",
          accent: "#37CDBE",
          neutral: "#3D4451",
          "base-100": "#FFFFFF",
          info: "#3ABFF8",
          success: "#36D399",
          warning: "#FBBD23",
          error: "#F87272",
        },
      },
    ],
  },
};
