<x-layouts.app>

<h1>{{ $brand->name }}</h1>

<p>{{ __('introduction_texts.type_list', ['brand' => $brand->name]) }}</p>


@if(isset($topManuals) && $topManuals->count())
    <h2>Top 5 populaire handleidingen</h2>

      @foreach ($topManuals as $manual)
       <button>
           <a href="{{ route('manual.show', [
               'brand_id' => $brand->id,
               'brand_slug' => $brand->getNameUrlEncodedAttribute(),
               'type_id' => $manual->type?->id ?? null,
               'type_slug' => $manual->type?->getNameUrlEncodedAttribute() ?? null,
               'manual_id' => $manual->id
           ]) }}">
               {{ $manual->name }}
           </a>
       </button>
       <br>
   @endforeach


    <hr>
@endif


<h2>Alle handleidingen</h2>

@foreach ($manuals as $manual)
    @if ($manual->locally_available)
        <a href="{{ route('manual.show', [
            'brand_id'     => $brand->id,
            'brand_slug'   => $brand->getNameUrlEncodedAttribute(),
            'type_id'      => $manual->type->id,
            'type_slug'    => $manual->type->getNameUrlEncodedAttribute(),
            'manual_id'    => $manual->id,
        ]) }}"
           class="manual-btn"
           title="{{ $manual->name }}">
            {{ $manual->name }}
        </a>
        <span class="filesize">({{ $manual->filesize_human_readable }})</span>
    @else
<<<<<<< HEAD
        <button class="manuals">
            <a href="{{ route('manual.show', ['manual_id' => $manual->id]) }}" target="_blank" title="{{ $manual->name }}">
                {{ $manual->name }}
            </a>
        </button>
=======
        <a href="{{ $manual->url }}"
           class="manual-btn external"
           target="_blank"
           title="{{ $manual->name }}">
            {{ $manual->name }}
        </a>
>>>>>>> d781011ba1341df1300688fad9d0b2a825bc1b89
    @endif
    <br>
@endforeach

</x-layouts.app>
