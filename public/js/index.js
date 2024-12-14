const editTodoModal = document.getElementById('editTodoModal');
editTodoModal.addEventListener('show.bs.modal', (event) => {
    const button = event.relatedTarget;
    const todoId = button.getAttribute('data-id');
    const todoTask = button.getAttribute('data-task');
    const todoDueDate = button.getAttribute('data-due_date');

    const modalTitle = editTodoModal.querySelector('.modal-title');
    const taskInput = editTodoModal.querySelector('#task');
    const dueDateInput = editTodoModal.querySelector('#due_date');
    const todoIdInput = editTodoModal.querySelector('#todo_id');
    const formAction = document.getElementById('editTodoForm');

    modalTitle.textContent = 'Edit Todo';
    taskInput.value = todoTask;
    todoIdInput.value = todoId;
    dueDateInput.value = todoDueDate ? todoDueDate : '';

    formAction.action = '/todos/' + todoId;
});
