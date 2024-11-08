
<form action="{{ $action }}" method="POST">

    @csrf
    @method($method)

    <div class="mt-4">
        <x-input-label for="name" :value="__('Name')" />
        <input
            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            id="name" name="name" type="text" value="{{ old('name', $priority->name) }}" required>
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

   <div class="flex justify-between gap-2">
    <div class="mt-4 w-1/2">
        <x-input-label for="description" :value="__('Description')" />
        <input
            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            id="description" name="description" type="text" value="{{ old('name', $priority->description) }}" required>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
    <div class="mt-4 w-1/2">
        <x-input-label for="color" :value="__('Color')" />
        <input
            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
            id="color" name="color" type="color" value="{{ old('name', $priority->color) }}" required>
        
        <x-input-error :messages="$errors->get('color')" class="mt-2" />
    </div>
   </div>

    {{-- Action Buttons --}}
    <div class="flex items-center justify-end mt-4">

        <a
        class="px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
        href="{{ route('admin.priorities.index') }}">
            {{ __('Cancel') }}
        </a>

        <button type="submit" class="ms-4 px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
            {{ $method === 'POST' ? __('Create') : __('Update') }}
        </button>
    </div>
    {{-- Action Buttons --}}


</form>
