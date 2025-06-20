<x-layout>
    @section('content')
        @include('habitday.scripts.habitdayManager')
        <a class="btn btn-primary" onclick="window.habitdayManager.openHabitdayFormAddOrEditPopup()" icon="fa fa-plus">ADD</a>
        <div id='grid_habitday' class='shadow' style='height: 650px;'></div>
    @endsection
</x-layout>



