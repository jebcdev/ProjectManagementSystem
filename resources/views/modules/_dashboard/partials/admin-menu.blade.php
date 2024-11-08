@if (auth()->user()->isAdmin == true)
    <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex text-center">

        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.index')">
            {{ __('Users') }}
        </x-nav-link>

        <x-nav-link :href="route('admin.statuses.index')" :active="request()->routeIs('admin.statuses.index')">
            {{ __('Statuses') }}
        </x-nav-link>

        <x-nav-link :href="route('admin.priorities.index')" :active="request()->routeIs('admin.priorities.index')">
            {{ __('Priorities') }}
        </x-nav-link>

        <x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.index')">
            {{ __('Projects') }}
        </x-nav-link>

        <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')">
            {{ __('Tasks') }}
        </x-nav-link>
    </div>
@endif
