@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white dark:bg-gray-700', 'trigger'])

<div {{ $attributes->merge(['class' => 'dropdown']) }}>
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        {{ $trigger }}
    </a>

    <div class="dropdown-menu">
        {{ $content }}
    </div>
</div>
