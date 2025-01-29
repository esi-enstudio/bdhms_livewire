<div class="text-center">
    @if (session()->has('message'))
        <p class="font-semibold text-green-500">{{ session('message') }}</p>
    @endif
</div>
