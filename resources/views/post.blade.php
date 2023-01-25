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
                </a>
            </div>

            <a href="#">
                <img class="rounded-t-lg" src="{{ asset('images/' . $post->imageName) }}" alt="{{ $post->title }}" />
            </a>
            <div class="p-5">
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $post->content }}</p>
                <div class="inline-flex float-right">
                    <form method="POST" action="{{ route('likePost', $post->id) }}">
                        @csrf
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                            @if (isset($isLiked) && $isLiked==true)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 fill-green-500"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z">
                                    </path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 fill-gray-700"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z">
                                    </path>
                                </svg>
                            @endif
                        </button>
                    </form>
                    <button class="bg-gray-300  text-gray-800 font-bold py-2 px-4">
                        {{$allLikes}}
                    </button>
                    <form method="POST" action="{{ route('dislikePost', $post->id) }}">
                        @csrf
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
                            @if (isset($isDisliked) && $isDisliked==true)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 fill-red-500" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path
                                        d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z">
                                    </path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 fill-gray-700"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M18 9.5a1.5 1.5 0 11-3 0v-6a1.5 1.5 0 013 0v6zM14 9.667v-5.43a2 2 0 00-1.105-1.79l-.05-.025A4 4 0 0011.055 2H5.64a2 2 0 00-1.962 1.608l-1.2 6A2 2 0 004.44 12H8v4a2 2 0 002 2 1 1 0 001-1v-.667a4 4 0 01.8-2.4l1.4-1.866a4 4 0 00.8-2.4z">
                                    </path>
                                </svg>
                            @endif
                        </button>
                    </form>
                </div>
                <div class="inline-flex">
                    @if (session()->has('userId') && session()->get('userId') == $post->userId)
                        <form method="POST" action="{{ route('deletePost', $post->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-700 w-24 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Delete
                            </button>
                        </form>
                        &nbsp;&nbsp;
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
