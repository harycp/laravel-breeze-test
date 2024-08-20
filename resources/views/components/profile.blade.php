<div class="w-full mb-4 bg-white p-4 rounded-lg shadow">

    <div class="flex items-center space-x-4">
        <img class="h-16 w-16 rounded-full object-cover" src="{{ asset('img/avatars.svg') }}" alt="User Image">
        <div>
            <h2 class="text-xl font-semibold">{{ Auth::user()->name }}</h2>
            <p class="text-gray-500">{{ Auth::user()->email }}</p>
        </div>
    </div>

    <button
        class="bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg w-full mt-4 transition-colors duration-300 ease-in-out hover:bg-gray-300 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 hover:scale-105">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <a :href="route('logout')"
                onclick="event.preventDefault();
                        this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>
    </button>
</div>
