<button {{ $attributes->merge(['type' => 'submit', 'class' => 'mt-3 mb-3 btn btn-primary font-weight-bold text-sm transition']) }}>
    {{ $slot }}
</button>
