@props(['error'])

@error($error)
<p {{ $attributes->merge(['class' => 'font-semibold text-sm text-red-600 dark:text-red-400']) }}>{{ $message }}</p>
@enderror
