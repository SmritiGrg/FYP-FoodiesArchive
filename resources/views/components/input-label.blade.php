@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-poppins font-medium text-sm text-slate-600']) }}>
    {{ $value ?? $slot }} <span class="text-red-500">*</span>
</label>
