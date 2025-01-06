<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'font-medium rounded-lg text-sm px-5 py-2.5 w-full uppercase inline-flex items-center justify-center bg-gradient-to-r from-amber-100 via-amber-200 to-amber-100 hover:bg-gradient-to-r hover:from-amber-100 hover:via-amber-300 hover:to-amber-100 text-black']) }}>
    {{ $slot }}
</button>
