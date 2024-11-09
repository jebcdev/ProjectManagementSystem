<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-center">
            <h2
                class="px-6 py-3 font-extrabold text-2xl text-gray-800 dark:text-gray-100 bg-red-100 dark:bg-red-900 rounded-lg shadow-lg tracking-widest uppercase border-2 border-red-600 dark:border-red-700">
                {{ __('Deadlines Overview') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="mx-auto sm:px-6 lg:px-8 space-y-4">
            {{-- Panel de Proyectos --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-4">{{ __('Projects Deadlines') }}</h3>

                    {{-- Proyectos con deadlines en la próxima semana --}}
                    <h4 class="text-lg font-semibold mb-2">{{ __('Upcoming Deadlines (Next 7 Days)') }}</h4>
                    @foreach ($projects as $project)
                        @if ($project->tasks->where('due_date', '>=', now()->startOfDay())->where('due_date', '<=', now()->addDays(7))->isNotEmpty())
                            <div class="mb-4">
                                <h5 class="text-md font-semibold">
                                    <a href="{{ route('projects.show', $project) }}"
                                        class="text-blue-600 dark:text-blue-400 hover:underline">{{ $project->name }}</a>
                                </h5>
                                {{-- Mostrar estado y prioridad --}}
                                <div class="flex justify-between">
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                                        style="background-color: {{ $project->status?->color }};">
                                        {{ $project->status?->name }}
                                    </span>
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                                        style="background-color: {{ $project->priority?->color }};">
                                        {{ $project->priority?->name }}
                                    </span>
                                </div>
                                {{-- Mostrar tareas próximas --}}
                                @foreach ($project->tasks->where('due_date', '>=', now()->startOfDay())->where('due_date', '<=', now()->addDays(7)) as $task)
<div class="flex justify-between border-b border-gray-200 py-2">
                                        <span>
                                            <a href="{{ route('tasks.show', $task) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $task->name }}</a>
                                            - <span class="font-medium">{{ $task->due_date->format('d/m/Y') }}</span>
                                        </span>

                                        <span class="text-sm">
                                            <span class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full" style="background-color: {{ $task?->status?->color }};">
                                                {{ $task?->status?->name }}
                                            </span>
                                            <span class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full" style="background-color: {{ $task?->priority?->color }};">
                                                {{ $task?->priority?->name }}
                                            </span>    
                                        </span>
                                        
                                    </div>
@endforeach
                            </div>
@endif
@endforeach

                    {{-- Proyectos con deadlines vencidos --}}
                    <h4 class="text-lg font-semibold mt-4 mb-2">{{ __('Overdue Deadlines') }}</h4>
                    @foreach ($projects as $project)
@if ($project->tasks->where('due_date', '<', now())->isNotEmpty())
<div class="mb-4">
                                <h5 class="text-md font-semibold">
                                    <a href="{{ route('projects.show', $project) }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ $project->name }}</a>
                                </h5>
                                {{-- Mostrar estado y prioridad --}}
                                <div class="flex justify-between">
                                    <span class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full" style="background-color: {{ $project->status?->color }};">
                                        {{ $project->status?->name }}
                                    </span>
                                    <span class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full" style="background-color: {{ $project->priority?->color }};">
                                        {{ $project->priority?->name }}
                                    </span>
                                </div>
                                {{-- Mostrar tareas vencidas --}}
                                @foreach ($project->tasks->where('due_date', '<', now()) as $task)
                                    <div class="flex justify-between border-b border-gray-200 py-2">
                                        <span>
                                            <a href="{{ route('tasks.show', $task) }}"
                                                class="text-blue-600 dark:text-blue-400 hover:underline">{{ $task->name }}</a>
                                            - <span
                                                class="font-medium text-red-500">{{ $task->due_date->format('d/m/Y') }}</span>
                                        </span>

                                        <span class="text-sm">
                                            <span
                                                class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                                                style="background-color: {{ $task?->status?->color }};">
                                                {{ $task?->status?->name }}
                                            </span>
                                            <span
                                                class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                                                style="background-color: {{ $task?->priority?->color }};">
                                                {{ $task?->priority?->name }}
                                            </span>
                                        </span>
                                        {{-- <span class="text-sm">{{ $task?->status?->name }} | {{ $task->priority->name }}</span> --}}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Panel de Tareas --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-semibold mb-4">{{ __('Tasks Deadlines') }}</h3>

                    {{-- Tareas con deadlines en la próxima semana --}}
                    <h4 class="text-lg font-semibold mb-2">{{ __('Upcoming Deadlines (Next 7 Days)') }}</h4>
                    @foreach ($tasks->where('due_date', '>=', now()->startOfDay())->where('due_date', '<=', now()->addDays(7))->groupBy('priority_id') as $priorityId => $tasksByPriority)
                        @php
                            $priority = $priorities->firstWhere('id', $priorityId);
                        @endphp
                        <div class="mb-4">
                            <h5 class="text-md font-semibold">{{ $priority->name }}</h5>
                            @foreach ($tasksByPriority as $task)
                                <div class="flex justify-between border-b border-gray-200 py-2">
                                    <span>
                                        <a href="{{ route('tasks.show', $task) }}"
                                            class="text-blue-600 dark:text-blue-400 hover:underline">{{ $task->name }}</a>
                                        - <span class="font-medium">{{ $task->due_date->format('d/m/Y') }}</span>
                                    </span>
                                    <span class="text-sm">{{ $task->project->name }} |
                                        {{ $task->status->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    {{-- Tareas vencidas --}}
                    <h4 class="text-lg font-semibold mt-4 mb-2">{{ __('Overdue Tasks') }}</h4>
                    @foreach ($tasks->where('due_date', '<', now())->groupBy('priority_id') as $priorityId => $tasksByPriority)
                        @php
                            $priority = $priorities->firstWhere('id', $priorityId);
                        @endphp
                        <div class="mb-4">
                            <span
                                class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                                style="background-color: {{ $priority?->color }};">
                                <h5 class="text-md font-semibold">{{ $priority->name }}</h5>
                            </span>
                            @foreach ($tasksByPriority as $task)
                                <div class="flex justify-between border-b border-gray-200 py-2">
                                    <span>
                                        <a href="{{ route('tasks.show', $task) }}"
                                            class="text-blue-600 dark:text-blue-400 hover:underline">{{ $task->name }}</a>
                                        - <span
                                            class="font-medium text-red-500">{{ $task->due_date->format('d/m/Y') }}</span>
                                    </span>
                                    <span class="text-sm">
                                        <span
                                            class="inline-block px-3 py-1  font-semibold text-white border border-white rounded-full"
                                            >
                                            {{ $task->project->name }}
                                        </span>
                                        <span
                                            class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                                            style="background-color: {{ $task?->status?->color }};">
                                            {{ $task?->status?->name }}
                                        </span>
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
