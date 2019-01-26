function addTask(task, uId) {
    let block = $("<div></div>").text(task);

    $(block).attr("class", "todo");
    $(block).attr("id", uId);
    $("#ft_list").prepend(block);
}

$(document).ready(function() {
    $("#new").click(function() {
        let task = prompt("What to do?", "");

        if (task !== "") {
            let date = new Date(new Date().getTime() + 7 * 24 * 60 * 3600 * 1000);
            let uId = date.getTime();

            document.cookie = uId + "=" + encodeURIComponent(task) + "; path=/; expires=" + date.toUTCString();
            addTask(task, uId);
        }
    });

    $(document).on("click", ".todo", function() {
       if (confirm("You really did this task?")) {
           $(this).remove();
           $.cookie = $(this).attr("id") + encodeURIComponent(task) + "; path=/; eexpires=Thu, 01 Jan 1970 00:00:01 GMT;"
       }
    });

    if (document.cookie) {
        let tasks = document.cookie.split(';');

        for (let i = 0; i < tasks.length; i++) {
            let temp = tasks[i].split('=');
            addTask(temp[1], temp[0]);
        }
    }
});