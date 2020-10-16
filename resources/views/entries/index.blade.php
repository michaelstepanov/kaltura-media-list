@extends('layouts.app')

@section('content')

    <h1 class="text-center mt-3">Entries</h1>

    <hr>

    @include('partials.message')

    <div class="row">
        <form class="form-inline col-md-4" action="{{ route('entries.index') }}" method="GET">
            <div class="input-group mb-3">
                <input type="hidden" name="_order" value="{{ $input['_order'] }}" >
                <input type="text" name="freeText" value="{{ $input['freeText'] }}" class="form-control" placeholder="Search for..." aria-label="Search for..." aria-describedby="go">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit" id="go">Go!</button>
                </div>
            </div>
        </form>
    </div>

    <div class="row">
        <div class="col-md-12">
            @include('entries.table', [
                'rows' => $entries,
            ])
        </div>
    </div>

@endsection
