@props([
    'disabled' => false,
    'label',
    'type' => 'text',
    'error' => '',
    ])

<div class="space-y-3">
    <div>
      @if($label)
        <label
            for="{{ $error }}"
            class="block text-sm font-medium mb-2 dark:text-white capitalize"
        >
            {{ $label }}
        </label>
      @endif
      <div class="relative">
        <input {{ $attributes->merge(['id' => $error, 'type' => $type, 'class' => 'py-3 px-4 block w-full border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600' ]) }} {{ $disabled ? 'disabled' : '' }}>
          <x-input-error :error="$error"/>
      </div>
    </div>
</div>
