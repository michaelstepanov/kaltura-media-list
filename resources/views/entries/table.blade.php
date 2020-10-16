<div class="table-responsive">
    @if ($entries->count() > 0)
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Thumbnail</th>
                <th>Name</th>
                <th>Entry ID</th>
                <th>Duration</th>
                <th>
                    Created At <a href="{{ route('entries.index', $orderUrlParams) }}"><i class="fa fa-angle-{{ ($input['_order'] === App\Apis\Kaltura\MediaEntryOrderBy::CREATED_AT_DESC) ? 'down' : 'up' }}" aria-hidden="true"></i></a>
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($entries as $entry)
                <tr>
                    <th scope="row">
                        {{ ($entries->currentPage() - 1) * $entries->perPage() + $loop->iteration }}
                    </th>
                    <td>
                        <img src="{{ $entry->thumbnailUrl }}" alt="{{ $entry->name }}">
                    </td>
                    <td>{{ $entry->name }}</td>
                    <td>{{ $entry->id }}</td>
                    <td>{{ $entry->duration }}</td>
                    <td>{{ Carbon::parse($entry->createdAt) }}</td>
                    <td>
                        <form action="{{ url("/entries/{$entry->id}") }}" method="POST">
                            <input class="btn btn-danger" type="submit" value="Delete" />
                            @method('delete')
                            @csrf
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $entries->links() }}
    @else
        <h2>No data</h2>
    @endif
</div>
