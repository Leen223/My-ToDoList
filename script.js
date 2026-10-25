
const form = document.querySelector("form");
const input = document.getElementById("input-list");
const todoList = document.getElementById("todo-list");

form.addEventListener("submit", function(event) {
    event.preventDefault();

    const task = input.value.trim();

    if (task === "") return;

    const li = document.createElement("li");

    const checkbox = document.createElement("input");
    checkbox.type = "checkbox";

    const span = document.createElement("span");
    span.textContent = task;

    const deleteBtn = document.createElement("button");
    deleteBtn.textContent = "Delete";
    deleteBtn.className = "delete-btn";

    deleteBtn.addEventListener("click", function() {
        li.remove();
    });

    li.append(checkbox, span, deleteBtn);
    todoList.appendChild(li);

    input.value = "";
});
