<div>
    @once
        <link rel="stylesheet" href="{{ asset('vendor/magic/magic.css') }}">
    @endonce
    <div class="magic-container">
        <span contenteditable wire:input="_update($event.target.innerText)">
            {{ $value }}
        </span>

        <button class="reset-button" wire:click="_reset" title="Reset to original">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-rotate-ccw">
                <polyline points="1 4 1 10 7 10"></polyline>
                <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
            </svg>
        </button>
    </div>
</div>
