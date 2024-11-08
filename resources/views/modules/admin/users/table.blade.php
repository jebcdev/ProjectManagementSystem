
<div class="overflow-x-auto">
    <table class="min-w-full table-auto" id="table">
        <thead>
            <tr class="bg-gray-100 dark:bg-gray-700">
                <th class="px-4 py-2 text-left">{{ __('Name') }}</th>
                <th class="px-4 py-2 text-left">{{ __('Email') }}</th>
                <th class="px-4 py-2 text-left">{{ __('Is Admin') }}</th>
                <th class="px-4 py-2 text-center">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="border-b dark:border-gray-600">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->isAdmin ? __('Yes') : __('No') }}</td>
                    <td class="px-4 py-4 text-center">
                        <form class="flex justify-center gap-2" action="{{ route('admin.users.destroy', $user) }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <a class="px-3 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                href="{{ route('admin.users.edit', $user) }}">
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
    {{-- Pagination --}}
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
