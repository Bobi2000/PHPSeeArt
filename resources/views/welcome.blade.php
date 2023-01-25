@include('partials.head')

<body>
    @include('partials.navbar')

    @foreach ($listPosts as $listPost)
        <br />
        <div class="flex items-center justify-center">
            <div
                class="max-w-xl bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="p-5">
                    <div class="flex">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $listPost->title }}</h5>
                    </div>
                    <a href="{{ url('/user', $listPost->userId) }}"
                        class="float-right items-center px-3 py-2 text-sm font-medium text-center">
                        {{ $listPost->username }}
                    </a>
                </div>

                <a href="{{ url('/post', $listPost->id) }}">
                    <img class="rounded-t-lg" src="{{ asset('images/' . $listPost->imageName) }}"
                        alt="{{ $listPost->title }}" />
                </a>
                <div class="p-5">
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $listPost->content }}</p>
                    <div class="inline-flex float-right">
                        <form method="POST" action="{{ route('likePost', $listPost->id) }}">
                            @csrf
                            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                                @if (isset($listPost->isLike) && $listPost->isLike)
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
                            {{ $listPost->countLikes }}
                        </button>
                        <form method="POST" action="{{ route('dislikePost', $listPost->id) }}">
                            @csrf
                            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
                                @if (isset($listPost->isDislike) && $listPost->isDislike)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 fill-red-500"
                                        viewBox="0 0 20 20" fill="currentColor">
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
                        @if (session()->has('userId') && session()->get('userId') == $listPost->userId)
                            <form method="POST" action="{{ route('deletePost', $listPost->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 w-24 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Delete
                                </button>
                            </form>
                            &nbsp;&nbsp;
                            <form method="POST" action="{{ route('editPost', $listPost->id) }}">
                                @csrf
                                @method('POST')
                                <button type="submit"
                                    class="bg-gray-500 hover:bg-gray-700 w-24 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Edit
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <br />
            </div>
        </div>
    @endforeach
    <br />
    {{-- @foreach ($listPosts as $listPost)
        <p>Title {{ $listPost->title }}</p>
        <p>Content {{ $listPost->content }}</p>
        @if (session()->has('userId') && session()->get('userId') == $listPost->userId)
            <form method="POST" action="{{ route('deletePost', $listPost->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Delete
                </button>
            </form>
            <form method="POST" action="{{ route('editPost', $listPost->id) }}">
                @csrf
                @method('POST')
                <button type="submit"
                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Edit
                </button>
            </form>
        @endif
    @endforeach --}}

    <!-- <div class="flex items-center justify-center h-screen">
        <div class="text-white font-bold rounded-lg">
            <div class="w-full max-w-xs">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Username
                        </label>
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                        <p class="text-red-500 text-xs italic">Please choose a password.</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                            Sign In
                        </button>
                        <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
                            Forgot Password?
                        </a>
                    </div>
                </form>
                <p class="text-center text-gray-500 text-xs">
                    &copy;2020 Acme Corp. All rights reserved.
                </p>
            </div>
        </div>
    </div> -->
</body>

</html>
