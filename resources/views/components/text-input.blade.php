@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-white border-gray-300 focus:ring-teal-500 rounded-md shadow-sm']) !!}>
