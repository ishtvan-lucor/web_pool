function addTask(task, id) {
    var block = $("<div></div>").text(task);
    $(block).attr("class", "todo");
    $(block).attr("id", id);
    $("#ft_list").prepend(block);
}

$(document).ready(function() {
    let id = 1;

    $.ajax({
        url: "select.php",
        success: function(response) {
            let data = $.parseJSON(response);
            if (data.length > 0) {
                id = data[data.length - 1][0];
                id++;
            }
            for(let i = 0; i < data.length; i++) {
                addTask(data[i][1], data[i][0]);
            }
        }
    });

    $("#new").click(function() {
        let task = prompt("Input TODO item: ", "");
        if (task.trim() !== "") {
            $.ajax({
                url: "insert.php?id=" + id + "&task=" + task,
                cache: false,
                success: function() {
                    addTask(task, id);
                    id++;
                }
            });
        }
    });

    $(document).on("click", ".todo", function() {
        let result = confirm("Confirm deleting this TODO");
        if (result) {
            $.ajax({
                url: "delete.php?id=" + $(this).attr("id"),
                cache: false,
                success: function(response) {}
            });
            $(this).remove();
        }
    });
});