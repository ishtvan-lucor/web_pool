function createTask() {
    let task = prompt("What to do?", "");

    if (task !== "") {
        let date = new Date(new Date().getTime() + 7 * 24 * 60 * 3600 * 1000);
        let uId = date.getTime();

        document.cookie = uId + "=" + encodeURIComponent(task) + "; path=/; expires=" + date.toUTCString();
                      console.log(uId);
        addTask(task, uId);
    }
}

function deleteTask(div, id) {
    if (confirm("You really did this task?")) {
        let deathTime = new Date(new Date().getTime() + (-1));

        document.getElementById("ft_list").removeChild(div);
        document.cookie = id + "=delete; path=/; expires=" + deathTime.toUTCString();
    }
}

function addTask(task, uId) {
    let parrentDiv = document.getElementById("ft_list");
    let newDiv = document.createElement('div');

    newDiv.innerHTML = task;
    newDiv.setAttribute('class', "todo");
    newDiv.setAttribute('id', uId);
    newDiv.setAttribute('onclick', 'deleteTask(this, id)');
    parrentDiv.insertBefore(newDiv, parrentDiv.firstChild);
}

window.onload = function() {
    if (document.cookie) {
        let parametrs = document.cookie.split(';');
        let temp;

        for (i = 0; i < parametrs.length; i++ ) {
            temp = parametrs[i].split('=');
            addTask(temp[1], temp[0]);
        }
    }
};