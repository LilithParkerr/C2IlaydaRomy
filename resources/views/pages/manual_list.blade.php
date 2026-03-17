<x-layouts.app>
    <h1>{{ $brand->name }}</h1>

    <p>{{ __('introduction_texts.type_list', ['brand' => $brand->name]) }}</p>

    @if(isset($topManuals) && $topManuals->count())
        <p>Top 5 populaire handleidingen</p>
        @foreach ($topManuals as $manual)
            <a href="{{ route('manual.show', [
                    'brand_id' => $brand->id,
                    'brand_slug' => $manual->type?->id ? $brand->getNameUrlEncodedAttribute() : null,
                    'type_id' => $manual->type?->id ?? null,
                    'type_slug' => $manual->type?->getNameUrlEncodedAttribute() ?? null,
                    'manual_id' => $manual->id
                ]) }}"
                class="manual-btn"
                title="{{ $manual->name }}">
                {{ $manual->name }}
            </a>
            <br>
        @endforeach
        <hr>
    @endif

    <p>Alle handleidingen</p>
    @foreach ($manuals as $manual)
        <a href="{{ route('manual.show', [
                'brand_id' => $brand->id,
                'brand_slug' => $brand->getNameUrlEncodedAttribute(),
                'type_id' => $manual->type?->id ?? null,
                'type_slug' => $manual->type?->getNameUrlEncodedAttribute() ?? null,
                'manual_id' => $manual->id,
            ]) }}"
            class="manual-btn"
            title="{{ $manual->name }}"
            @if(!$manual->locally_available) target="_blank" @endif>
            {{ $manual->name }}
            @if($manual->locally_available)
                <span class="filesize">({{ $manual->filesize_human_readable }})</span>
            @endif
        </a>
        <br>
    @endforeach
</x-layouts.app>
