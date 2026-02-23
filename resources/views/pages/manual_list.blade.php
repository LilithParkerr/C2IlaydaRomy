<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li>
            <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/"
               alt="Manuals for '{{ $brand->name }}'"
               title="Manuals for '{{ $brand->name }}'">
               {{ $brand->name }}
            </a>
        </li>
    </x-slot:breadcrumb>

    <h1>{{ $brand->name }}</h1>

    <p>{{ __('introduction_texts.type_list', ['brand' => $brand->name]) }}</p>

    @foreach ($manuals as $manual)
        @if ($manual->locally_available)
            <button>
                {{-- Gebruik nu automatisch de top_url route als deze beschikbaar is --}}
                <a href="{{ $manual->top_url ?? url('/' . $brand->id . '/' . $brand->getNameUrlEncodedAttribute() . '/' . $manual->id) }}"
                   alt="{{ $manual->name }}"
                   title="{{ $manual->name }}">
                    {{ $manual->name }}
                </a>
            </button>
            ({{ $manual->filesize_human_readable }})
        @else
            <button class="manuals">
                <a href="{{ $manual->url }}" target="_blank" alt="{{ $manual->name }}" title="{{ $manual->name }}">
                    {{ $manual->name }}
                </a>
            </button>
        @endif
        <br />
    @endforeach

</x-layouts.app>
