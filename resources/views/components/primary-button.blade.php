<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'flex justify-center items-center py-3 px-4 border border-transparent text-lg font-medium rounded-lg text-white bg-gradient-to-r from-pink-500 to-red-500 hover:bg-gradient-to-l focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500']) }}>
    {{ $slot }}
</button>
