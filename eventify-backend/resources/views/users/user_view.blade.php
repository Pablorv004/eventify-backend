@extends('layouts.app')
@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            @include('partials.errors')
            @include('partials.messages')

            <div class="mb-4 d-flex justify-content-between" role="group">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach($categories as $category)
                            <li><button class="dropdown-item"
                                    onclick="showEventsList('{{ strtolower($category->name) }}')">{{ $category->name }}</button>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Events Menu
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><button class="dropdown-item"
                                onclick="showEventsList('user')">My Events</button>
                        </li>
                        <li><button class="dropdown-item"
                                onclick="showEventsList('all')">All Events</button>
                        </li>
                    </ul>
                </div>
            </div>

            <div id="user_events_table" style="{{ $currentCategory == 'all' ? 'display: block;' : 'display: none;' }}">
                @include('partials.events.user_events_table', ['events' => $events, 'category_name' => 'all'])
            </div>

            @foreach($categories as $category)
                <div id="{{ strtolower($category->name) }}_events_table"
                    style="{{ $currentCategory == strtolower($category->name) ? 'display: block;' : 'display: none;' }}">
                    @include('partials.events.user_events_table', ['events' => $events, 'category_name' => $category->name])
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function showEventsList(listType) {
        const url = new URL(window.location.href);
        url.searchParams.set('category', listType);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    }
</script>
@endsection