import { generateClasses } from "@formkit/themes";
import { pl, en } from "@formkit/i18n";

export default {
  locales: { pl, en },
  config: {
    classes: generateClasses({
      global: {
        outer: "formkit-disabled:opacity-50 uppercase text-xs font-semibold",
        messages: "list-none p-0 mt-1 mb-0 ",
        message: "text-red-500 mb-1 text-xs",
        input:
          "w-full h-12 border-2 border-gray-300 rounded-xl shadow-sm font-normal",
      },
      submit: {
        input: "",
      },
      button: {
        input: "",
      },
    }),
  },
};
