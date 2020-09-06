@extends('layouts')

@section('head')
<title>{{ site_name() }}</title>
@endsection

@section('content')
    <div class="container py-5">
        <div class="text-center">
            <h2>Popular Hashtags</h2>
            <div class="mt-4">
                <ul class="list-inline">
                    @foreach (collect(hashtags())->shuffle()->take(33) as $item)
                    <li class="list-inline-item py-1 px-2 rounded bg-light mb-3 border">
                        <a href="{{ hashtag_url($item) }}">#{{ $item }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="bg-light">
        <div class="container py-5">
            <div class="row">
                <div class="col-12 mb-4 text-center">
                    <h2>Popular Posts</h2>
                </div>
                @php
                    $tag = collect(hashtags())->shuffle()->take(1)[0];
                @endphp
                @foreach (collect(get_data($tag))->chunk(5)->toArray() as $items)
                    @foreach (collect($items)->shuffle()->all() as $key => $item)
                        @if ($key == 1)
                            <div class="col-md-4 mb-3">
                                <!--ads/responsive-->
                            </div>
                        @endif
                        @php
                            $data = collect($item)->collapse()->all();
                        @endphp
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="{{ $data['image'] }}" class="card-img-top" alt="{{ $data['caption'] }}">
                                <div class="card-body">
                                    <p class="card-text small text-muted" style="max-height: 5rem; overflow: auto;">{{ $data['caption'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-4 mb-3">
                        <!--ads/responsive-->
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection