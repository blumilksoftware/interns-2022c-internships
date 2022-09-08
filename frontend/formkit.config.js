import { generateClasses } from '@formkit/themes'

export default {
    config: {
        classes: generateClasses({
            global: {
                outer: 'formkit-disabled:opacity-50',
            },
            text: {
                //outer: 'mb-5',
                //label: 'block mb-1 font-bold text-sm',
                //inner: 'max-w-md border border-gray-400 rounded-lg mb-1 overflow-hidden focus-within:border-blue-500',
                input: 'block max-w-lg w-80 shadow-sm focus:ring-primary focus:border-primary sm:text-sm border-gray-300 rounded-md',
                //help: 'text-xs text-gray-500',
                messages: 'list-none p-0 mt-1 mb-0',
                message: 'text-red-500 mb-1 text-xs'
            },
            submit: {
                input: 'group mt-2 relative w-60 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary',
            },
            button: {
                input: 'group mt-2 relative w-60 flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-800 hover:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary',
            },
        })
    }
}