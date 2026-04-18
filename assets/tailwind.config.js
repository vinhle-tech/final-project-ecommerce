tailwind.config = {
  theme: {
    screens: {
      // Desktop-first (max-width)
      xl: { max: "1536px" },
      lg: { max: "1280px" },
      md: { max: "1024px" },
      sm: { max: "768px" },
      xs: { max: "640px" },
    },

    extend: {
      colors: {
        primary: "#141718",
        gray: "#6C7275",
        gray2: "#f3f5f7",
        green: "#38CB89",
        backgroundSecondary: "#F3F5F7",
        blue: "#377DFF",
      },

      fontFamily: {
        inter: ["Inter", "sans-serif"],
        poppins: ["Poppins", "sans-serif"],
        space: ["Space Grotesk", "sans-serif"],
      },
    },
  },
  plugins: [],
};
