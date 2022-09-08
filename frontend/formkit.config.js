import { generateClasses } from '@formkit/themes'
import { pl, en } from '@formkit/i18n'

export default {
    locales: { pl, en },
    locale: 'pl',
    config: {
        classes: generateClasses({
            global: {
                outer: 'formkit-disabled:opacity-50',
                messages: 'list-none p-0 mt-1 mb-0',
                message: 'text-red-500 mb-1 text-xs',
            },
            text: {
                input: 'block max-w-lg w-80 shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md',
            },
            email: {
                input: 'block max-w-lg w-80 shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md',
            },
            url: {
                input: 'block max-w-lg w-80 shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md',
            },
            submit: {
                input: 'mt-2 relative w-60 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary',
            },
            button: {
                input: 'mt-2 relative w-60 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary',
            },
        })
    }
}