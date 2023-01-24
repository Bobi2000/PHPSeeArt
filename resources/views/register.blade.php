@include('partials.head')

<body>
    @include('partials.navbar')

    <div class="flex items-center justify-center h-screen">
        <div class="text-white font-bold rounded-lg">
            <div class="w-full max-w-xs">
                <form method="POST" action="{{ route('register') }}"
                    class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                            Username
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            name="username" id="username" type="text" placeholder="Username">
                        <p class="text-red-500 text-xs italic">{{ session('username-empty') }}</p>
                        <p class="text-red-500 text-xs italic">{{ session('username-error') }}</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            name="email" id="email" type="text" placeholder="Email">
                        <p class="text-red-500 text-xs italic">{{ session('email-empty') }}</p>
                        <p class="text-red-500 text-xs italic">{{ session('email-error') }}</p>
                    </div>
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                            Password
                        </label>
                        <input {{-- class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" --}}
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            name="password" id="password" type="password" placeholder="******************">
                        {{-- <p class="text-red-500 text-xs italic">Please choose a password.</p> --}}
                        <p class="text-red-500 text-xs italic">{{ session('password-empty') }}</p>
                    </div>
                    <div class="flex items-center justify-between">
                        <button
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit">
                            Sign In
                        </button>
                        {{-- <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
                            href="#">
                            Forgot Password?
                        </a> --}}
                    </div>
                </form>
                <p class="text-center text-gray-500 text-xs">
                    {{-- &copy;2020 Acme Corp. All rights reserved. --}}
                </p>
            </div>
        </div>
    </div>
</body>

</html>
