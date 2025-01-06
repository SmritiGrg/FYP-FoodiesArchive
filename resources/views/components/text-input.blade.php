{{-- @props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'text-slate-400 bg-white border-gray-300 focus:border-indigo-300 focus:ring-indigo-300 rounded-md shadow-sm',
]) !!}> --}}


@props(['disabled' => false, 'error' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'text-slate-400 bg-white border rounded-md shadow-sm ' .
        ($error
            ? 'border-red-500 focus:border-red-500 focus:ring-red-500'
            : 'border-gray-300 focus:border-indigo-300 focus:ring-indigo-300'),
]) !!}>
