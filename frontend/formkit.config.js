import { generateClasses } from "@formkit/themes"
import { pl, en } from "@formkit/i18n"

export default {
  locales: { pl, en },
  config: {
    classes: generateClasses({
      global: {
        outer: "formkit-disabled:opacity-50",
        messages: "list-none p-0 mt-1 mb-0",
        message: "text-red-500 mb-1 text-xs",
        input:
          "relative w-full my-2 max-w-lg w-screen ssm:w-80 shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md formkit-invalid:border-red-500",
      },
      submit: {
        input:
          "relative w-full m-y-2 w-60 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary disabled:opacity-20",
      },
      button: {
        input:
          "relative w-full m-y-2 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary",
      },
    }),
  },
}
