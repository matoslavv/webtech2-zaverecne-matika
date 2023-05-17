<!-- resources/views/students/index.blade.php -->
<x-app-layout>



    <h4>{{__('all-students')}}</h4>
    <table id="studentsTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{__('name')}}</th>
                <th>{{__('email')}}</th>
                <th>{{__('action')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>
                        <a href="{{ route('student-tasks.index', ['student' => $student->id]) }}" class="btn btn-primary">{{__('view-tasks')}}</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#studentsTable').DataTable();
            
        });
    </script>



</x-app-layout>

