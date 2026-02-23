<x-layouts.app>

    <x-slot:introduction_text>
        <p><img src="img/afbl_logo.png" align="right" width="100" height="100">{{ __('introduction_texts.homepage_line_1') }}</p>
        <p>{{ __('introduction_texts.homepage_line_2') }}</p>
        <p>{{ __('introduction_texts.homepage_line_3') }}</p>
    </x-slot:introduction_text>

    <h1>
        <x-slot:title>
            {{ __('misc.all_brands') }}
        </x-slot:title>
    </h1>

    {{-- Top 10 Populaire Handleidingen --}}
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <h2>top 10 manuals</h2>
                <div class="card">
                    <div class="card-body">
                        <ol>
                            @foreach($topManuals as $manual)
                                <li>
                                    <a href="/{{ $manual->brand_id }}/{{ $manual->brand->getNameUrlEncodedAttribute() }}/{{ $manual->id }}/">
                                        {{ $manual->brand->name }}: {{ $manual->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alfabetisch Menu --}}
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-12">
                <div style="position: sticky; top: 20px; z-index: 100; padding: 10px 0; background: white;">
                    <p style="margin-bottom: 10px;"><strong>Ga naar letter:</strong></p>
                    <div style="font-size: 1.1em; line-height: 1.8;">
                        @php
                            // Verzamel alle eerste letters van merken
                            $availableLetters = $brands->map(function($brand) {
                                return strtoupper(substr($brand->name, 0, 1));
                            })->unique()->sort()->values();
                        @endphp

                        @foreach(range('A', 'Z') as $index => $letter)
                            @if($index > 0)
                                <span style="color: #999;"> - </span>
                            @endif

                            @if($availableLetters->contains($letter))
                                <a href="#letter-{{ $letter }}"
                                   style="color: #007bff; text-decoration: none; font-weight: 500;">
                                    {{ $letter }}
                                </a>
                            @else
                                <span style="color: #ccc;">
                                    {{ $letter }}
                                </span>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Brands lijst met anchor tags --}}
    <?php
    $size = count($brands);
    $columns = 3;
    $chunk_size = ceil($size / $columns);
    ?>

    <div class="container">
        <div class="row">
            @foreach($brands->chunk($chunk_size) as $chunk)
                <div class="col-md-4">
                    <ul>
                        @foreach($chunk as $brand)
                            <?php
                            $current_first_letter = strtoupper(substr($brand->name, 0, 1));

                            if (!isset($header_first_letter) || (isset($header_first_letter) && $current_first_letter != $header_first_letter)) {
                                echo '</ul>
                                    <h2 id="letter-' . $current_first_letter . '" style="scroll-margin-top: 150px;">' . $current_first_letter . '</h2>
                                    <ul>';
                            }
                            $header_first_letter = $current_first_letter
                            ?>

                            <li>
                                <a href="/{{ $brand->id }}/{{ $brand->getNameUrlEncodedAttribute() }}/">{{ $brand->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <?php
                unset($header_first_letter);
                ?>
            @endforeach
        </div>
    </div>

    {{-- Smooth scrolling CSS --}}
    <style>
        html {
            scroll-behavior: smooth;
        }

        a[href^="#letter-"]:hover {
            text-decoration: underline !important;
        }
    </style>

</x-layouts.app>
