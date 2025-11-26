@extends('layouts')



@section('header')
<div class="card-header text-white d-flex justify-content-between align-items-center" style="background: #2196F3">
  <h4 class="mb-0"> Edit Task</h4>
</div>
@endsection

@section('content')
<form action="{{ route('tasks.update', $task->id) }}" method="POST">
          @csrf
          @method('PUT')
    <!-- Title -->
    <div class="mb-3">
      <label for="title" class="form-label fw-semibold">Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ $task->title }}" id="title" name="title" placeholder="Enter task title">
      <span class="text-danger">
        @error('title')
           {{ $message }}
        @enderror
      </span>
    </div>

    <!-- Description -->
    <div class="mb-3">
      <label for="description" class="form-label fw-semibold">Description</label>
      <textarea class="form-control @error('details') is-invalid @enderror" id="description"  rows="4" name="details" placeholder="Enter task details" >{{ $task->description }}</textarea>
      <span class="text-danger">
        @error('details')
           {{ $message }}
        @enderror
      </span>
    </div>

    <!-- Status -->
    <div class="mb-3">
      <label for="status" class="form-label fw-semibol">Status</label>
      <select id="status" class="form-select" name="status">
        <option value="pending" @if($task->status === 'pending') selected  @endif>Pending</option> 
        <option value="completed" @if($task->status === 'completed') selected  @endif>Completed</option>
        <option value="in_progress" @if($task->status === 'in_progress') selected  @endif>In Progress</option>
      </select>
      <span class="text-danger">
        @error('status')
           {{ $message }}
        @enderror
      </span>
    </div>

    <!-- Due Date -->
    <div class="mb-3">
      <label for="due_date" class="form-label fw-semibold">Due Date</label>
      <input type="date" class="form-control @error('due_date') is-invalid @enderror" value="{{ $task->due_date }}"  id="due_date" name="due_date">
      <span class="text-danger">
        @error('due_date')
           {{ $message }}
        @enderror
      </span>
    </div>

    <!-- Buttons -->
    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-primary">Update Task</button>
    </div>

  </form>

@endsection