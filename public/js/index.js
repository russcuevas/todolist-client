
const editTodoModal = document.getElementById('editTodoModal');
editTodoModal.addEventListener('show.bs.modal', (event) => {
    const button = event.relatedTarget;
    const todoId = button.getAttribute('data-id');
    const todoTask = button.getAttribute('data-task');

    const modalTitle = editTodoModal.querySelector('.modal-title');
    const taskInput = editTodoModal.querySelector('#task');
    const formAction = document.getElementById('editTodoForm');
    const todoIdInput = document.getElementById('todo_id');

    modalTitle.textContent = 'Edit Todo';
    taskInput.value = todoTask;
    todoIdInput.value = todoId;

    formAction.action = '/todos/' + todoId;
});