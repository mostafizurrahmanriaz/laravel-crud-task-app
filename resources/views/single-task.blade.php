@extends('layouts')



@section('content')
<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Task Details</h3>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">← Back</a>
    </div>

    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Task: {{ $task->title }}</h5>
        </div>

        <div class="card-body">

            <!-- ID -->
            <div class="mb-3">
                <label class="fw-bold">Task ID:</label>
                <p class="text-muted">{{ $task->id }}</p>
            </div>

            <!-- Title -->
            <div class="mb-3">
                <label class="fw-bold">Title:</label>
                <p>{{ $task->title }}</p>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="fw-bold">Description:</label>
                <div class="p-3 bg-light rounded">
                    {!! nl2br(e($task->description)) !!}
                </div>
            </div>

            <!-- Status -->
            <div class="mb-3">
                <label class="fw-bold">Status:</label><br>

                @if($task->status == 'completed')
                    <span class="badge bg-success">Completed</span>
                @elseif($task->status == 'in_progress')
                    <span class="badge bg-warning text-dark">In Progress</span>
                @else
                    <span class="badge bg-secondary">Pending</span>
                @endif
            </div>

            <!-- Due Date -->
            <div class="mb-3">
                <label class="fw-bold">Due Date:</label>
                <p>{{ $task->due_date }}</p>
            </div>
        </div>
    </div>
</div> <br>
@endsection