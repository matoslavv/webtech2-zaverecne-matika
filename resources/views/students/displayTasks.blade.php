<x-app-layout>
    <link href="{{ asset('app.css') }}" rel="stylesheet" />

    <h4>{{__('excersise-sets-for')}} {{ $student->name }}</h4>

    <table id="tasksTable" class="table table-striped">

        <thead>

            <tr>

                <th>ID</th>
                <th>{{__('From')}}</th>
                <th>{{__('To')}}</th>
                <th>{{__('state')}}</th>
                <th>{{__('points')}}</th>
                <th>{{__('max-points')}}</th>
                <!-- Add more columns as needed -->

            </tr>

        </thead>

        <tbody>

            @foreach ($exerciseSets as $exerciseSet)

                <tr>

                    <td>{{ $exerciseSet->id }}</td>
                    <td>{{ $exerciseSet->from_date }}</td>
                    <td>{{ $exerciseSet->to_date }}</td>
                    <td>{{ $exerciseSet->state }}</td>
                    <td>{{ $exerciseSet->points }}</td>
                    <td>{{ $exerciseSet->max_points }}</td>
                    <!-- Add more columns as needed -->

                </tr>

            @endforeach

        </tbody>

    </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tasksTable').DataTable();
            
        });
    </script>

</x-app-layout>
