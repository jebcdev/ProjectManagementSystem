<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
                href="{{ route('dashboard') }}">
                {{ __('Dashboard') }}
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        {{--  Menu Div--}}
        <div class="mx-auto sm:px-4 lg:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100 mb-4">

                    

                    <div>

                        @includeIf('modules._dashboard.partials.admin-menu')

                    </div>
                </div></div></div>
                {{--  Menu Div--}}
                <br>
                {{-- Main Content --}}
                <div class="mx-auto sm:px-4 lg:px-4">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 text-gray-900 dark:text-gray-100">
                    {{-- Stats --}}
                    <div class="flex justify-evenly">

                        {{-- Projects Stats --}}
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-1/3">
                            <h2 class="text-center text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ __('Projects Stats') }}</h2>

                            <div class="mt-4 text-gray-800 dark:text-gray-200 w-full">
                                <span
                                    class="text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                    {{ __('Total Projects') }}:
                                    <span
                                        class="font-semibold text-gray-900 dark:text-gray-100">{{ $projects?->count() }}</span></span>
                            </div>

                            <div class="flex justify-between gap-10">
                                {{-- Statuses --}}
                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                                        {{ __('By Statuses') }}</h3>
                                    <ul class="space-y-4 mt-4">
                                        @foreach ($statuses as $status)
                                            {{-- Card --}}
                                            <a href="#"
                                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                                <h5 class="rounded p-2 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                                    style="background-color: {{ $status?->color }}; hover:bg: {{ $status?->color }};">
                                                    {{ $status?->name }}</h5>
                                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                                    {{ $status?->projects?->count() }}
                                                    {{ Str::plural(__('Project'), $status?->projects?->count()) }}

                                                </p>
                                            </a>
                                            {{-- Card --}}
                                        @endforeach
                                    </ul>
                                </div>
                                {{-- Statuses --}}

                                {{-- Priorities --}}
                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                                        {{ __('By Priorities') }}</h3>
                                    <ul class="space-y-4 mt-4">
                                        @foreach ($priorities as $priority)
                                            {{-- Card --}}
                                            <a href="#"
                                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                                <h5 class="rounded p-2 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                                    style="background-color: {{ $priority?->color }}; hover:bg: {{ $priority?->color }};">
                                                    {{ $priority?->name }}</h5>
                                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                                    {{ $priority?->projects?->count() }}
                                                    {{ Str::plural(__('Project'), $priority?->projects?->count()) }}

                                                </p>
                                            </a>
                                            {{-- Card --}}
                                        @endforeach
                                    </ul>
                                </div>
                                {{-- Priorities --}}
                            </div>
                        </div>
                        {{-- Projects Stats --}}

                        {{-- Tasks Stats --}}
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md w-1/3">
                            <h2 class="text-center text-2xl font-semibold text-gray-900 dark:text-gray-100">
                                {{ __('Tasks Stats') }}</h2>

                               <div class="mt-4 text-gray-800 dark:text-gray-200">
                                <span
                                    class="text-center block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                    {{ __('Total Tasks') }}:
                                    <span
                                        class="font-semibold text-gray-900 dark:text-gray-100">{{ $tasks?->count() }}</span></span>
                            </div>
                            <div class="flex justify-between gap-10">
                                {{-- Statuses --}}
                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                                        {{ __('By Statuses') }}</h3>
                                    <ul class="space-y-4 mt-4">
                                        @foreach ($statuses as $status)
                                            {{-- Card --}}
                                            <a href="#"
                                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                                <h5 class="rounded p-2 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                                    style="background-color: {{ $status?->color }}; hover:bg: {{ $status?->color }};">
                                                    {{ $status?->name }}</h5>
                                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                                    {{ $status?->tasks?->count() }}
                                                    {{ Str::plural(__('Task'), $status?->tasks?->count()) }}

                                                </p>
                                            </a>
                                            {{-- Card --}}
                                        @endforeach
                                    </ul>
                                </div>
                                {{-- Statuses --}}

                                {{-- Priorities --}}
                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                                        {{ __('By Priorities') }}</h3>
                                    <ul class="space-y-4 mt-4">
                                        @foreach ($priorities as $priority)
                                            {{-- Card --}}
                                            <a href="#"
                                                class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                                <h5 class="rounded p-2 mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                                    style="background-color: {{ $priority?->color }}; hover:bg: {{ $priority?->color }};">
                                                    {{ $priority?->name }}</h5>
                                                <p class="font-normal text-gray-700 dark:text-gray-400">
                                                    {{ $priority?->tasks?->count() }}
                                                    {{ Str::plural(__('Task'), $priority?->tasks?->count()) }}

                                                </p>
                                            </a>
                                            {{-- Card --}}
                                        @endforeach
                                    </ul>
                                </div>
                                {{-- Priorities --}}
                            </div>
                        </div>
                        {{-- Tasks Stats --}}

                    </div>


                    {{-- Main Content --}}
                </div>
            </div></div></div>
            </div>
</x-app-layout>
