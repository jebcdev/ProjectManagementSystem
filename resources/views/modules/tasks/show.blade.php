<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Task Details') }} : {{ $task->name }}
            </h2>
            <a class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                href="{{ route('tasks.index') }}">
                {{ __('Tasks List') }}
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto sm:px-4 lg:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">

                    {{-- SessionMessage --}}
                    @includeIf('helpers.sessionMessage')
                    {{-- SessionMessage --}}

                    {{-- ErrorMessage --}}
                    @includeIf('helpers.errorMessage')
                    {{-- ErrorMessage --}}

                    {{-- Main Content --}}

                    <div>

                        {{-- name image --}}
                        <div class="bg-gray-700 rounded-lg p-2">
                            <h1 class="font-extrabold text-xl text-center">{{ $task?->name }}</h1>
                            <div class="mt-2">
                                @if ($task?->image_path)
                                    <img class="w-20 rounded-full mx-auto object-cover	"
                                        src="{{ Storage::url($task->image_path) }}"
                                        alt="{{ $task?->name }}">
                                @else
                                    <span class="border rounded-full p-1 inline-block w-32 h-32 text-center text-3xl">
                                        😢
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- name image --}}

                        {{-- Project Name --}}
                        <div class="w-full mt-4">
                            <span class="m-4">
                                <h2 class="font-extrabold underline">{{ __('Project') }}:</h2>
                                {{ $task?->project?->name }}
                            </span>
                        {{-- Project Name --}}

                        {{-- Rows --}}
                        <div class="flex justify-between gap-4">

                            {{-- Left Col --}}
                            <div class="mt-4">
                                <span class="m-4">
                                    <h2 class="font-extrabold underline">{{ __('Creator') }}:</h2>
                                    {{ $task?->creator?->name }}
                                </span>

                                <span class="mt-4">
                                    <h2 class="font-extrabold underline">{{ __('Updated By') }}:</h2>
                                    {{ $task?->updater ? $task?->updater?->name : __('No Updater') }}
                                </span>

                                <span class="mt-4">
                                    <h2 class="font-extrabold underline">{{ __('Status') }}:</h2>
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                                        style="background-color: {{ $task?->status?->color }};">
                                        {{ $task?->status?->name }}
                                    </span>
                                </span>

                                <span class="mt-4">
                                    <h2 class="font-extrabold underline">{{ __('Priority') }}:</h2>
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                                        style="background-color: {{ $task?->priority?->color }};">
                                        {{ $task?->priority?->name }}
                                    </span>
                                </span>

                            </div>
                            {{-- Left Col --}}

                            {{-- Right Col --}}
                            <div class="mt-4">
                                <span class="m-4">
                                    <h2 class="font-extrabold underline">{{ __('Start Date') }}:</h2>
                                    {{ $task?->start_date?->format('Y-m-d') }}
                                </span>

                                <span class="m-4">
                                    <h2 class="font-extrabold underline">{{ __('Due Date') }}:</h2>
                                    {{ $task?->due_date ? $task?->due_date->format('Y-m-d') : __('No Due Date') }}
                                </span>

                                <span class="m-4">
                                    <h2 class="font-extrabold underline">{{ __('Created At') }}:</h2>
                                    {{ $task?->created_at ? $task?->created_at->format('Y-m-d') : __('No Due Date') }}
                                </span>

                                <span class="m-4">
                                    <h2 class="font-extrabold underline">{{ __('Updated At') }}:</h2>
                                    {{ $task?->created_at != $task?->updated_at ? $task?->updated_at->format('Y-m-d') : __('Not Updated') }}
                                </span>
                            </div>
                            {{-- Right Col --}}
                            <div>

                                {{-- Empty Column --}}
                                {{-- Empty Column --}}

                            </div>
                        </div>

                        {{-- Rows --}}

                    </div>

                    {{-- Description --}}
                    <br><br>
                    <div class="m-5">
                        {{ $task?->description }}
                    </div>
                    {{-- Description --}}

                    {{-- Action Buttons --}}
                    <br>
                    <form class="flex justify-end gap-2" action="{{ route('tasks.destroy', $task) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            href="{{ route('tasks.edit', $task) }}">
                            {{ __('Edit') }}
                        </a>
                        <button
                            class="px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            type="submit" onclick="return confirm('{{ __('Are You Sure?') }}')">
                            {{ __('Delete') }}
                        </button>
                    </form>
                    {{-- Action Buttons --}}

                    {{-- Main Content --}}
                </div>
            </div>
        </div>
</x-app-layout>
