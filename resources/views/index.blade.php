<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>
<body>
    <div class="container">
        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center">
                <h5><i class="fa-solid fa-user"></i> Welcome, {{ Auth::user()->name }}</h5>
                <form action="{{ route('logout') }}" method="POST" class="logout-btn">
                    @csrf
                    <button type="submit" class="btn btn-danger-custom">Logout <i class="fa-solid fa-right-from-bracket"></i></button>
                </form>
            </div>

            <h1>Todo List</h1>
            <form action="{{ route('todos.store') }}" method="POST">
                @csrf
                <div class="input-group todo-input">
                    <input type="text" name="task" class="form-control" placeholder="Enter a new task" required>
                    <button type="submit" class="btn btn-custom">Add Todo <i class="fa-solid fa-plus"></i></button>
                </div>
            </form>

            <h4>MY TODO <i class="fa-solid fa-list-check"></i></h4>
            <ul class="todo-list">
                @foreach ($todos as $todo)
                    <li class="{{ $todo->status == 'completed' ? 'completed' : 'pending' }}">
                        <span class="task">{{ $todo->task }}</span>
                        <span class="status">{{ ucfirst($todo->status) }}</span>
                        <form action="{{ route('todos.update', $todo) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">
                                @if ($todo->status == 'completed') Uncheck <i class="fa-solid fa-check"></i> @else Check <i class="fa-solid fa-check"></i> @endif
                            </button>
                        </form>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTodoModal" data-id="{{ $todo->id }}" data-task="{{ $todo->task }}">
                            Edit <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete <i class="fa-solid fa-trash"></i></button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="modal fade" id="editTodoModal" tabindex="-1" aria-labelledby="editTodoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTodoModalLabel">Edit Todo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editTodoForm" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="todo_id" id="todo_id">
                        <div class="mb-3">
                            <label for="task" class="form-label">Task</label>
                            <input type="text" class="form-control" id="task" name="task" required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="float: right">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/index.js') }}"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    </script>
</body>
</html>
