<x-layouts.app>

    <x-slot:head>
        <meta name="robots" content="index, nofollow">
    </x-slot:head>

    <x-slot:breadcrumb>
        <li>
            <a href="{{ route('brand.show', [
                'brand_id' => $brand->id,
                'brand_slug' => $brand->getNameUrlEncodedAttribute()
            ]) }}"
               title="Manuals for '{{ $brand->name }}'">
                {{ $brand->name }}
            </a>
        </li>
        <li>
            <a href="{{ route('manual.top', [
                'brand_id' => $brand->id,
                'brand_slug' => $brand->getNameUrlEncodedAttribute(),
                'manual_id' => $manual->id
            ]) }}"
               title="View manual for '{{ $brand->name }}'">
                View
            </a>
        </li>
    </x-slot:breadcrumb>

    <h1>{{ $brand->name }} - {{ $manual->name }}</h1>

    {{-- Teller toevoegen --}}
    <p><strong>Aantal bezoekers:</strong> {{ $manual->fresh()->manualcounter }}</p>

    @if ($manual->locally_available)
        <iframe src="{{ $manual->url }}"
                width="780"
                height="600"
                frameborder="0"
                marginheight="0"
                marginwidth="0">
            Iframes are not supported<br />
            <a href="{{ $manual->url }}" target="_blank"
               title="Download your manual here">
               Click here to download the manual
            </a>
        </iframe>
    @else
        <a href="{{ $manual->url }}" target="_blank"
           title="Download your manual here">
           Click here to download the manual
        </a>
    @endif

</x-layouts.app>
