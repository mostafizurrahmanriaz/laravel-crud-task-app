@extends('layouts')



@section('header')
<div class="card-header text-white d-flex justify-content-between align-items-center" style="background: #2196F3">
  <h4 class="mb-0">All Tasks</h4>
  <a href="{{ route('tasks.create') }}" class="btn btn-light btn-sm fw-semibold">+ Add New Task</a>
</div>
@endsection

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
  <form action="{{ route('task.search') }}" method="GET" class="d-flex w-100">
      <input 
          type="text" 
          name="search" 
          class="form-control me-2" 
          placeholder="Search tasks by title or description" 
          value="{{ request('search') }}"
      >
      <button type="submit" class="btn btn-primary me-2">Search</button>
      <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Clear</a>
  </form>
</div>

@if (session('status'))
<div class="text-success">
   {{ session('status') }}
</div>
@endif

<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead class="table-primary">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Due Date</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tasks as $task)   
      <tr>
        <td>{{ $task->id }}</td>
        <td>{{ $task->title }}</td>
        <td>{{ \Illuminate\Support\Str::limit($task->description, 50, '...') }}</td>
        <td>
          @if ($task->status === 'completed')
          <span class="badge bg-success">Completed</span>
          @elseif ($task->status === 'pending')
          <span class="badge bg-secondary">Pending</span>
          @else
          <span class="badge bg-warning text-dark">In Progress</span>
          @endif
        </td>
        <td>{{ $task->due_date }}</td>
        <td>
          <a href="{{ route('tasks.show', $task->id) }}"><button class="btn btn-sm btn-secondary text-white">View</button></a>
        </td>
        <td>
          <a href="{{ route('tasks.edit',  $task->id) }}"><button class="btn btn-sm btn-primary text-white">Edit</button></a>
        </td>
        <td>
          <form action="{{ route('tasks.destroy',  $task->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<div>
  {{ $tasks->links('pagination::bootstrap-5') }}
</div>

@endsection