<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-4 py-3 text-center">
                    ID
                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    {{ __('Image') }}
                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    {{ __('Creator') }}
                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    {{ __('Project Name') }}
                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    {{ __('Status') }}
                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    {{ __('Priority') }}
                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    {{ __('Start D') }},
                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    {{ __('Due D') }}.
                </th>
                <th scope="col" class="px-4 py-3 text-center">
                    {{ __('Actions') }}
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td scope="row"
                        class="px-4 py-4 font-medium text-gray-900 text-center whitespace-nowrap dark:text-white">
                        {{ $project?->id }}
                    </td>

                    {{-- Image --}}

                    <td class="px-4 py-4 text-center">
                        @if ($project?->image_path)
                            <img class="w-10 h-10 rounded-full"
                                 src="{{ Storage::url($project->image_path) }}"
                                 alt="{{ $project->name }}">
                        @else
                            <span class="border rounded-full p-1 inline-block w-8 h-8 text-center">
                                😢
                            </span>
                        @endif
                    </td>
                    

                    {{-- Image --}}

                    <td class="px-4 py-4 text-center">
                        {{ $project?->creator?->name }}
                    </td>
                    <td class="px-4 py-4 text-center">
                        <a class="p-1 border-white border-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700 text-wrap"
                            href="{{ route('projects.show', $project) }}" style="word-wrap: break-word; max-width: 150px; display: inline-block; overflow: hidden; text-overflow: ellipsis;">
                            <span class="text-wrap">
                                {{ $project?->name }}
                            </span>
                        </a>
                    </td>
                    
                    <td class="px-4 py-4 text-center">
                        <span
                            class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                            style="background-color: {{ $project?->status?->color }};">
                            {{ $project?->status?->name }}
                        </span>
                    </td>
                    {{--  --}}
                    <td class="px-4 py-4 text-center">
                        <span
                            class="inline-block px-3 py-1 text-xs font-semibold text-white border border-white rounded-full"
                            style="background-color: {{ $project?->priority?->color }};">
                            {{ $project?->priority?->name }}
                        </span>
                    </td>

                    {{--  --}}
                    <td class="px-4 py-4 text-center">
                        {{ $project?->start_date?->format('Y-m-d') }}
                    </td>
                    <td class="px-4 py-4 text-center">
                        {{ $project?->due_date ? $project?->due_date?->format('Y-m-d') : __('No D. Date') }}
                    </td>

                    <td class="px-4 py-4 text-center">
                        <form class="flex justify-center gap-2" action="{{ route('projects.destroy', $project) }}"
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
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="m-2 p-2 border-white">
        {{ $projects->links() }}
    </div>
</div>
