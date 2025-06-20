<x-layout>

@foreach($days as $day)

        <div class="card miniform">
            <div class="card-header">
                <div>{{ $day->day }}</div>
            </div>
            <div class="card-body">
                <div style="width: 50%; float: left; margin-top: 10px">
                    <div>
                        @if(!is_null($day->log))
                            {!! $day->log !!}
                        @else
                            <a class='btn btn-primary' href="{{ route('log.form', ['day' => $day->id]) }}">Ajouter une entrée du journal</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>

@endforeach

</x-layout>
