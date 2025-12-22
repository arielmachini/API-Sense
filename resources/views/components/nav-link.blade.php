@props(['active' => false])

<a class="{{ $active ? 'active fw-semibold nav-link' : 'nav-link'}}" {{ $attributes }}{{ $active ? 'aria-current=page' : '' }}>
    {{ $slot }}
</a>