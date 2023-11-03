<x-table.table-panel tableName="Tasks" :paginatorAttr="$tasks">
    <div class="container flex items-center">
        <form method="GET" action="/task">
            @csrf
            <x-form.input inputName="search" type="date" value="{{ request('search') }}"/>
            <x-form.button  buttonName="search" class=""/>
        </form>

        <form method="GET" action="/task" class="mr-5">
            @csrf
            <x-form.input inputName="searchbody" value="{{ request('search') }}"/>
            <x-form.button  buttonName="search"/>
        </form>
    </div>
    <table id="tasks-table" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Date Created</th>
                <th>Task Name</th>
                <th>Created By</th>
                <th>Assigned to</th>
                <th>Due</th>
                <th>Completed</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="hover:bg-grey-lighter">
                    <td>{{ date_format($task->created_at, 'd/m/Y') }}</td>
                    <td class="py-4 px-6 border-b border-grey-light">
                        <a href="/task/{{$task->id}}" class="underline">{{ ucwords($task->title) }}</a>
                    </td>
                    <td>{{ $task->getTaskCreatorUser() }}</td>
                    <td>{{ $task->getAssignedUser() }}</td>
                    <td>{{ date('d/m/Y', strtotime($task->due)) }}</td>
                    <td>{{ $task->completed ? 'Yes' : 'No' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-table.table-panel>

@push('scripts')
<script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tasks-table').DataTable();
    });
</script>
@endpush
