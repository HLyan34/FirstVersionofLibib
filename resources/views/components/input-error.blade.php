@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400 ps-0']) }}>
        @foreach ((array) $messages as $message)
        <div class="alert alert-danger" role="alert">
            {{ $message }}
          </div>
        @endforeach
    </ul>
@endif
