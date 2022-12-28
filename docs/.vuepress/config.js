import { defineUserConfig } from "vuepress";
import { defaultTheme } from "@vuepress/theme-default";
import { registerComponentsPlugin } from '@vuepress/plugin-register-components'
import { getDirname, path } from '@vuepress/utils'

const __dirname = getDirname(import.meta.url)

export default defineUserConfig({
  plugins: [
    registerComponentsPlugin({
      componentsDir: path.resolve(__dirname, './components'),
    }),
  ],
  port: process.env.EXTERNAL_DOCS_PORT,
  base: process.env.VUEPRESS_BASE || "/",
  sidebar: "auto",
  markdown: {
    importCode: {
      handleImportPath: (str) =>
        str.replace(/^@/, path.resolve(__dirname, '../assets')),
    },
  },
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
            link: "/pl/technical/",
          },
          {
            text: "Dokumentacja użytkowa",
            link: "/pl/user/",
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
              ],
            },
          ],
        },
      },
      "/en": {
        navbar: [
          {
            text: "Technical documentation",
            link: "/en/technical/",
          },
          {
            text: "User documentation",
            link: "/en/user/",
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
              ],
            },
          ],
        },
      },
    },
  }),
});
