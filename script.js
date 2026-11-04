const singleForm = document.getElementById("single-form");
const bulkForm = document.getElementById("bulk-form");
const input = document.getElementById("input-list");
const bulkInput = document.getElementById("bulk-input");
const todoList = document.getElementById("todo-list");
const emptyMessage = document.getElementById("empty-message");

function updateEmptyMessage() {
    emptyMessage.hidden = todoList.children.length > 0;
}

function addTask(text) {
    const li = document.createElement("li");

    const span = document.createElement("span");
    span.textContent = text;

    const buttons = document.createElement("div");
    buttons.className = "task-buttons";

    const doneBtn = document.createElement("button");
    doneBtn.type = "button";
    doneBtn.textContent = "Done";
    doneBtn.addEventListener("click", function () {
        const completed = span.classList.toggle("completed");
        doneBtn.textContent = completed ? "Undo" : "Done";
    });

    const deleteBtn = document.createElement("button");
    deleteBtn.type = "button";
    deleteBtn.textContent = "Delete";
    deleteBtn.className = "delete-btn";
    deleteBtn.addEventListener("click", function () {
        li.remove();
        updateEmptyMessage();
    });

    buttons.append(doneBtn, deleteBtn);
    li.append(span, buttons);

    // Newest task on top, same as the PHP version (ORDER BY id DESC)
    todoList.prepend(li);
    updateEmptyMessage();
}

singleForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const task = input.value.trim();
    if (task === "") return;

    addTask(task);
    input.value = "";
    input.focus();
});

bulkForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const tasks = bulkInput.value
        .split("\n")
        .map(function (line) { return line.trim(); })
        .filter(Boolean);

    // Add in reverse so the first line ends up on top
    tasks.reverse().forEach(addTask);
    bulkInput.value = "";
});

updateEmptyMessage();