@props([
        'checkbox' => false,
        'value' => null,
        'title' => '',
        'subtitle' => '',
        'avatar' => null,
        'showAvatar' => false,
        'status' => null,
        'status_type' => '',
        'link' => false,
        'link_url' => '#',
        ])

@if($checkbox)
    <td class="size-px whitespace-nowrap">
        <div class="ps-6 py-3 pr-3">
            <label class="flex">
                <input @if($value) value="{{ $value }}" @endif {{ $attributes->merge(['type' => 'checkbox','class' => 'shrink-0 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800']) }}>
                <span class="sr-only">Checkbox</span>
            </label>
        </div>
    </td>
@else
    <td class="size-px whitespace-nowrap">
        <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
            <div class="flex items-center gap-x-3">

                {{-- Avatar--}}
                @if($showAvatar)
                    @if($avatar)
                        <img class="inline-block size-[38px] rounded-full object-cover" src="{{ url('storage/'.$avatar) }}" alt="Avatar">
                    @else
                        <span class="inline-flex items-center justify-center size-[38px] rounded-full bg-white border border-gray-300 dark:bg-neutral-800 dark:border-neutral-700">
                        <span class="font-medium text-sm text-gray-800 leading-none dark:text-neutral-200">
                            {{ Str::upper(Str::substr($title, 0, 1)) }}
                        </span>
                    </span>
                    @endif
                @endif

                <div class="grow">
                    {{-- Status--}}
                    @if(isset($status))
                        @switch($status_type)
                            @case('success')
                                <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-full dark:bg-teal-500/10 dark:text-teal-500">
                                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                    </svg>
                                    {{ Str::title($status) }}
                                </span>
                            @break

                            @case('warning')
                                <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full dark:bg-yellow-500/10 dark:text-yellow-500">
                                    <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                    </svg>
                                    {{ Str::title($status) }}
                                </span>
                            @break

                            @case('danger')
                                <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-red-100 text-red-800 rounded-full dark:bg-red-500/10 dark:text-red-500">
                                  <svg class="size-2.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                  </svg>
                                  {{ Str::title($status) }}
                                </span>
                            @break
                        @endswitch
                    @endif

                    @if($slot)
                        <span class="block px-2 text-sm font-semibold text-gray-800 dark:text-neutral-200">
                            {{ $slot }}
                        </span>
                    @endif

                    @if($title)
                        @if($link)
                            @php $segments = explode('/', parse_url($link_url, PHP_URL_PATH)) @endphp
                            @if($segments[2] == 0)
                                <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                {{ $title }}
                            </span>
                            @else
                                <a wire:navigate href="{{ $link_url }}" class="block text-sm font-semibold text-gray-800 dark:text-neutral-200 hover:underline">
                                    {{ $title }}
                                </a>
                            @endif
                        @else
                            <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">
                                {{ $title }}
                            </span>
                        @endif
                    @endif

                    @if($subtitle)
                        <span class="block text-sm text-gray-500 dark:text-neutral-500">
                            {{ $subtitle }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </td>
@endif
