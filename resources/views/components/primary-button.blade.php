<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'font-semibold rounded-lg text-sm px-5 py-2.5 w-full uppercase inline-flex items-center justify-center bg-customYellow hover:bg-hovercustomYellow text-black']) }}>
    {{ $slot }}
</button>
