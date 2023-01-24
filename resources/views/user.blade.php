@include('partials.head')

<body>
    @include('partials.navbar')

    <div class="text-center  text-gray-800 py-20 px-6">
        <h1 class="text-3xl font-bold mt-0 mb-6"><a href="{{ url('/user', $user->id) }}">{{$user->name}}:</a></h1>
        {{-- <h3 class="text-3xl font-bold mb-8"></h3> --}}
    </div>

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
                    <div class="grid grid-cols-2 grid-rows-1">
                        @if (session()->has('userId') && session()->get('userId') == $listPost->userId)
                            <form method="POST" action="{{ route('deletePost', $listPost->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 w-24 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Delete
                                </button>
                            </form>
                            <form method="POST" action="{{ route('editPost', $listPost->id) }}">
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
    @endforeach
    <br/>
</body>

</html>
