@if (session('errorMessage'))
<div class="flex justify-center my-4">
    <div
        class="bg-gray-800 border border-red-700 font-extrabold text-white text-center rounded-lg px-4 py-2 shadow-lg">
        {{ session('errorMessage') }}
    </div>
</div>
@endif