<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Add Task To') }}: {{ $project->name }}
            </h2>
            <a class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
                href="{{ url()->previous() }}">
                {{ __('Return ') }}
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="mx-auto sm:px-4 lg:px-4">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900 dark:text-gray-100">

                    {{-- Main Content --}}

                    <div>

                        <form action="{{ route('projects.save-task') }}" method="POST" enctype="multipart/form-data">

                            @csrf
                            @method('POST')

                                <input type="hidden" name="created_by" id="created_by"
                                    value="{{ $task->created_by}}">


                            {{-- Validacion si es para crear o actualizar --}}

                            {{-- name image --}}
                            <div class="bg-gray-700 rounded-lg p-2">
                                <h1 class="font-extrabold text-xl text-center">{{ $task?->name }}</h1>
                                <div class="mt-2">
                                    @if ($task?->image_path)
                                        <img class="w-20 rounded-full mx-auto object-cover	"
                                            src="{{ Storage::url($task->image_path) }}"alt="{{ $task?->name }}">
                                    @endif
                                </div>
                                <x-input-label for="image_path" :value="__('Image')" />
                                <input
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    type="file" name="image_path" id="image_path">
                                <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
                            </div>
                            {{-- name image --}}

                            {{-- Project --}}
                            <div class="w-full mt-4">
                                <x-input-label for="project_id" :value="__('Project')" />

                                <input
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                type="text"
                               value="{{ old('name', $task->project->name) }}" readonly>
                                            
                               <input type="hidden" id="project_id" name="project_id" value="{{ $task->project_id }}">

                                <x-input-error :messages="$errors->get('project_id')" class="mt-2" />
                                {{-- Project --}}

                                {{-- name description --}}
                                <div class="flex gap-4 mt-4">
                                    {{-- Name --}}
                                    <div class="w-full mt-4">
                                        <x-input-label for="name" :value="__('Name')" />

                                        <input
                                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                            id="name" name="name" type="text"
                                            value="{{ old('name', $task->name) }}" required>

                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    {{-- Name --}}

                                    {{-- Description --}}
                                    <div class="w-full mt-4">
                                        <x-input-label for="description" :value="__('Description')" />

                                        <textarea
                                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                            id="description" name="description" required>{{ old('description', $task->description) }}</textarea>

                                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                    </div>
                                    {{-- Description --}}
                                </div>
                                {{-- name description --}}


                                {{-- status_id | priority_id --}}
                                <div class="flex gap-4 mt-4">
                                    {{-- Status --}}
                                    <div class="w-full mt-4">
                                        <x-input-label for="status_id" :value="__('Status')" />

                                        <select
                                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                            name="status_id" id="status_id"
                                            value="{{ old('status_id', $task?->status_id) }}" required>

                                            <option value="">{{ __('Select Status') }}</option>

                                            @foreach ($statuses as $status)
                                                <option value="{{ $status->id }}"
                                                    {{ old('status_id', $task?->status_id) == $status->id ? 'selected' : '' }}>
                                                    {{ $status->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        <x-input-error :messages="$errors->get('status_id')" class="mt-2" />
                                    </div>
                                    {{-- Status --}}

                                    {{-- Priority --}}
                                    <div class="w-full mt-4">
                                        <x-input-label for="image_path" :value="__('Priority')" />

                                        <select
                                            class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                            name="priority_id" id="priority_id"
                                            value="{{ old('priority_id', $task?->priority_id) }}" required>

                                            <option value="">{{ __('Select Priority') }}</option>

                                            @foreach ($priorities as $priority)
                                                <option value="{{ $priority->id }}"
                                                    {{ old('priority_id', $task?->priority_id) == $priority->id ? 'selected' : '' }}>
                                                    {{ $priority->name }}
                                                </option>
                                            @endforeach

                                        </select>

                                        <x-input-error :messages="$errors->get('priority_id')" class="mt-2" />
                                    </div>
                                    {{-- Priority --}}
                                </div>
                                {{-- status_id | priority_id --}}




                                {{-- start_date due_date --}}
                                <div class="flex gap-4 mt-4">
                                    {{-- start_date --}}
                                    <div class="w-full mt-4">
                                        <x-input-label for="start_date" :value="__('Start Date')" />

                                        <input
                                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                            id="start_date" name="start_date" type="date"
                                            value="{{ old('start_date', $task->start_date ? $task->start_date->format('Y-m-d') : '') }}"
                                            required>


                                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                                    </div>
                                    {{-- start_date --}}

                                    {{-- due_date --}}
                                    <div class="w-full mt-4">
                                        <x-input-label for="due_date" :value="__('Due Date')" />

                                        <input
                                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                            id="due_date" name="due_date" type="date"
                                            value="{{ old('start_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
                                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                                    </div>
                                    {{-- due_date --}}
                                </div>
                                {{-- start_date due_date --}}


                                {{-- Action Buttons --}}
                                <div class="flex items-center justify-end mt-4">

                                    <a class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
                                        href="{{ route('tasks.index') }}">
                                        {{ __('Cancel') }}
                                    </a>

                                    <button type="submit"
                                        class="ms-4 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                                        {{  __('Create') }}
                                    </button>
                                </div>
                                {{-- Action Buttons --}}

                        </form>


                    </div>

                    {{-- Main Content --}}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
