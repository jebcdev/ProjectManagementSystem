<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Projects List') }} | {{ $projects->total() }}
                {{ Str::plural(__('Project'), $projects->total()) }}
            </h2>
            <a class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
                href="{{ route('projects.create') }}">
                {{ __('Create') }}
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto sm:px-4 lg:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">

                    {{-- Main Content --}}

                    {{-- SessionMessage | Error Message --}}
                    @includeIf('helpers.sessionMessage')
                    @includeIf('helpers.errorMessage')
                    {{-- SessionMessage | Error Message --}}

                    {{-- Search Header --}}
                    @includeIf('helpers.search-header', [
                        'route' => 'projects.index',
                    ])
                    {{-- Search Header --}}
                    {{-- Table --}}
                    <div>
                        @includeIf('modules.projects.table')
                    </div>
                    {{-- Table --}}

                    {{-- Main Content --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
