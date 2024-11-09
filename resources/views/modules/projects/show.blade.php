<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Projects Details') }} : {{ $project->name }}
            </h2>
            <a class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                href="{{ route('projects.index') }}">
                {{ __('Projects List') }}
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
                            <h1 class="font-extrabold text-xl text-center">{{ $project?->name }}</h1>
                            <div class="mt-2">
                                @if ($project?->image_path)
                                    <img class="w-20 rounded-full mx-auto object-cover	"
                                        src="{{ Storage::url($project->image_path) }}" alt="{{ $project?->name }}">
                                @else
                                    <span class="border rounded-full p-1 inline-block w-32 h-32 text-center text-3xl">
                                        😢
                                    </span>
                                @endif
                            </div>
                        </div>
                        {{-- name image --}}

                        {{-- Rows --}}
                        <div class="flex justify-between gap-4">

                            {{-- Left Col --}}
                            <div class="mt-4">
                                <span class="m-4">
                                    <h2 class="font-extrabold underline">{{ __('Creator') }}:</h2>
                                    {{ $project?->creator?->name }}
                                </span>

                                <span class="mt-4">
                                    <h2 class="font-extrabold underline">{{ __('Updated By') }}:</h2>
                                    {{ $project?->updater ? $project?->updater?->name : __('No Updater') }}
                                </span>

                                <span class="mt-4">
                                    <h2 class="font-extrabold underline">{{ __('Status') }}:</h2>
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                                        style="background-color: {{ $project?->status?->color }};">
                                        {{ $project?->status?->name }}
                                    </span>
                                </span>

                                <span class="mt-4">
                                    <h2 class="font-extrabold underline">{{ __('Priority') }}:</h2>
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                                        style="background-color: {{ $project?->priority?->color }};">
                                        {{ $project?->priority?->name }}
                                    </span>
                                </span>

                            </div>
                            {{-- Left Col --}}

                            {{-- Right Col --}}
                            <div class="mt-4">
                                <span class="m-4">
                                    <h2 class="font-extrabold underline">{{ __('Start Date') }}:</h2>
                                    {{ $project?->start_date?->format('Y-m-d') }}
                                </span>

                                <span class="m-4">
                                    <h2 class="font-extrabold underline">{{ __('Due Date') }}:</h2>
                                    {{ $project?->due_date ? $project?->due_date->format('Y-m-d') : __('No Due Date') }}
                                </span>

                                <span class="m-4">
                                    <h2 class="font-extrabold underline">{{ __('Created At') }}:</h2>
                                    {{ $project?->created_at ? $project?->created_at->format('Y-m-d') : __('No Due Date') }}
                                </span>

                                <span class="m-4">
                                    <h2 class="font-extrabold underline">{{ __('Updated At') }}:</h2>
                                    {{ $project?->created_at != $project?->updated_at ? $project?->updated_at->format('Y-m-d') : __('Not Updated') }}
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
                        {{ $project?->description }}
                    </div>
                    {{-- Description --}}

                    {{-- Action Buttons --}}
                    <br>
                    <form class="flex justify-end gap-3" action="{{ route('projects.destroy', $project) }}"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            href="{{ route('projects.edit', $project) }}">
                            {{ __('Edit') }}
                        </a>
                        <button
                            class="px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                            type="submit" onclick="return confirm('{{ __('Are You Sure?') }}')">
                            {{ __('Delete') }}
                        </button>

                        <a 
                        class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                        href="{{ route('projects.add-task',$project) }}">
                    {{__('Add Task')}}
                    </a>
                    </form>
                    {{-- Action Buttons --}}

                    @if ($project->tasks->count())
                        <div class="mt-4">
                            @includeIf('modules.tasks.table', ['tasks' => $project->tasks])
                        </div>
                    @endif

                    {{-- Main Content --}}
                </div>
            </div>
        </div>
</x-app-layout>
