@props(['name', 'show' => false, 'maxWidth' => '2xl'])

{{-- Ghi chú (Tiếng Việt):
    - Component modal dùng Alpine.js để điều khiển hiển thị modal.
    - Sử dụng event `open-modal`/`close-modal` để điều khiển từ JS hoặc các component khác.
    - Nếu muốn dùng modal thuần JS, cân nhắc tách logic JS riêng (ví dụ `ui-helpers.js`).
--}}

@php
    $id = $name instanceof \Illuminate\Support\HtmlString ? md5($name) : $name;
    $id ??= md5($attributes->wire('model'));

    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            return [...$el.querySelectorAll(
                'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), [tabindex]:not([tabindex=\"-1\"])',
            )];
        },
        firstFocusable() { return this.focusables()[0]; },
        lastFocusable() { return this.focusables().slice(-1)[0]; },
        nextFocusable() { return this.focusables()[this.focusables().indexOf(document.activeElement) + 1] || this.firstFocusable(); },
        prevFocusable() { return this.focusables()[this.focusables().indexOf(document.activeElement) - 1] || this.lastFocusable(); },
    }"
    x-init="$watch('show', value => value && setTimeout(() => firstFocusable().focus(), 100))"
    x-on:open-modal.window="$event.detail == '{{ $id }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $id }}' ? show = false : null"
    x-show="show"
    class="fixed inset-0 z-50 overflow-y-auto px-4 py-6 sm:px-0"
    style="display: none;"
>
    <div x-show="show" class="fixed inset-0 transform transition-all" x-on:click="show = false" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div x-show="show"
        class="mb-6 bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }}"
        x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        {{ $slot }}
    </div>
</div>

