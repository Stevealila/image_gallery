<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
        
    <form action="{{ url('/store') }}" method="post" enctype="multipart/form-data" class="my-10 w-6/12 mx-auto">
        @csrf

        <div class="mb-4">
            <input type="file" name="images[]" id="image" multiple>
            <button class="py-1 px-2 bg-teal-500 hover:bg-teal-700 text-gray-100">Save</button>
        </div>

    </form>

    <div class="flex space-4 flex-wrap w-6/12 mx-auto">
        @foreach($posts as $post)
            @if (Auth::user()->id == $post->user_id)
                <img src="{{ asset('images/'. $post->image) }}" alt="Image" class="object-cover w-32 h-20 m-4">
            @endif
        @endforeach
    </div>

</x-app-layout>
