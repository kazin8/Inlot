@if ($unit->date_release_id and $unit->run)
    <p>
        @if ($unit->date_release_id)
            {{ $unit->date_release_id }},
        @endif
        @if ($unit->run)
            {{ $unit->runFormat }} км
        @endif
    </p>
@endif