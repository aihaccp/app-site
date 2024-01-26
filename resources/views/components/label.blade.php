@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-xl']) }}>
    {{ $value ?? $slot }}
</label>
