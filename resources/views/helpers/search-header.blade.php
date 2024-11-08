    {{-- Header and Search Filters --}}
    <div class="mt-2 mb-4 text-center">
        <form action="{{ route($route) }}">
            <div class="border-white rounded-full p-2">

                <a class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
                    href="{{ route($route) }}">
                    {{ __('Clear') }}
                </a>


                <input
                    class="w-1/2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                    type="text" id="search" name="search" value="{{ request('search') }}" />

                <x-primary-button>
                    {{ __('Search') }}
                </x-primary-button>

                {{-- Total Results --}}
                @if ($totalResults != null)
                    <span class="ml-5 text-gray-700 dark:text-gray-400">
                        {{ __('Total Results') }}: {{ $totalResults }}
                    </span>
                @endif
                {{-- Total Results --}}


            </div>
        </form>
    </div>
    {{-- Header and Search Filters --}}
