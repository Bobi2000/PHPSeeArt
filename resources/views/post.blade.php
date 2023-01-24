@include('partials.head')

<body>
    @include('partials.navbar')

    <br />
    <div class="flex items-center justify-center">
        <div class="max-w-5xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="p-5">
                <div class="flex">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        {{ $post->title }}</h5>
                </div>
                <a href="{{ url('/user', $post->userId) }}"
                    class="float-right items-center px-3 py-2 text-sm font-medium text-center">
                    {{ $user->name }}
                    {{-- <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg> --}}
                </a>
            </div>

            <a href="#">
                <img class="rounded-t-lg" src="{{ asset('images/' . $post->imageName) }}" alt="{{ $post->title }}" />
            </a>
            <div class="p-5">
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $post->content }}</p>
                <div class="grid grid-cols-2 grid-rows-1">
                    @if (session()->has('userId') && session()->get('userId') == $post->userId)
                        <form method="POST" action="{{ route('deletePost', $post->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 w-24 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Delete
                            </button>
                        </form>
                        <form method="POST" action="{{ route('editPost', $post->id) }}">
                            @csrf
                            @method('POST')
                            <button type="submit"
                                class="float-right bg-gray-500 hover:bg-gray-700 w-24 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Edit
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
