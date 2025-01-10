<div>
    <h2 class="mt-10 mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-gray">Poll List</h2>

    @forelse ($polls as $index => $poll)

    <div class="mb-4">
        <h3 class="mb-2 text-lg font-semibold text-gray-900 dark:text-gray">{{ $poll->title }}</h3>

        @foreach ($poll->options as $option)
        <table class="w-full table-fixed text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <tbody>
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <!-- <div class="flex items-center mx-auto ml-3 mt-3"> -->
                    <td class="px-6 py-4 w-10">
                        <button class="p-1.5 mr-2 text-sm font-medium text-white bg-gray-700 rounded-lg border border-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z" clip-rule="evenodd" />
                            </svg>
                            <span class="sr-only">Vote</span>
                        </button>
                    </td>
                    <td class="px-6 py-4">
                        {{ $option->name }}
                    </td>

                    <td class="px-6 py-4 text-right w-10">
                        {{ $option->votes->count() }}
                    </td>
                    <!-- </div> -->
                </tr>
            </tbody>
        </table>
        @endforeach
    </div>

    @empty

    <p>No polls available</p>

    @endforelse
</div>