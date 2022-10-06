import { defineUserConfig } from "vuepress";
import { defaultTheme } from "@vuepress/theme-default";

export default defineUserConfig({
  sidebar: "auto",
  title: "Internships",
  description: "Project documentation",

  locales: {
    "/en": {
      lang: "English",
    },
    "/pl": {
      lang: "Polski",
    },
  },

  theme: defaultTheme({
    locales: {
      "/": {
        navbar: [
          {
            text: "GitHub",
            link: "https://github.com/blumilksoftware/internships",
          },
        ],
      },
      "/pl": {
        navbar: [
          {
            text: "Dokumentacja techniczna",
            link: "technical",
          },
          {
            text: "Dokumentacja użytkowa",
            link: "user",
          },
          {
            text: "GitHub",
            link: "https://github.com/blumilksoftware/internships",
          },
        ],
        sidebar: {
          "/pl/technical": [
            {
              text: "Dokumentacja techniczna",
              children: [
                "/pl/technical/index.md",
                "/pl/technical/architecture.md",
                "/pl/technical/configure.md",
                "/pl/technical/run.md",
                "/pl/technical/migrations-and-seeders.md",
                "/pl/technical/commands.md",
              ],
            },
          ],
          "/pl/user": [
            {
              text: "Dokumentacja użytkowa",
              children: [
                "/pl/user/index.md",
                "/pl/user/manage-account.md",
                "/pl/user/manage-company.md",
                "/pl/user/manage-site.md",
              ],
            },
          ],
        },
      },
      "/en": {
        navbar: [
          {
            text: "Technical documentation",
            link: "technical",
          },
          {
            text: "User documentation",
            link: "user",
          },
          {
            text: "GitHub",
            link: "https://github.com/blumilksoftware/internships",
          },
        ],
        sidebar: {
          "/en/technical": [
            {
              text: "Technical documentation",
              children: [
                "/en/technical/index.md",
                "/en/technical/architecture.md",
                "/en/technical/configure.md",
                "/en/technical/run.md",
                "/en/technical/migrations-and-seeders.md",
                "/en/technical/commands.md",
              ],
            },
          ],
          "/en/user": [
            {
              text: "User documentation",
              children: [
                "/en/user/index.md",
                "/en/user/manage-account.md",
                "/en/user/manage-company.md",
                "/en/user/manage-site.md",
              ],
            },
          ],
        },
      },
    },
  }),
});
