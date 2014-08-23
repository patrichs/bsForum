$(document).ready(function()
    {
        function getThreads()
        {
            $.post("php/getActiveThreads.php",
                function(data) {
                    for (var i in data)
                    {
                        var title = data[i].title;
                        var description = data[i].description;
                        var threadId = data[i].id;
                        var dateCreated = data[i].created_date;
                        var commentsCount = data[i].comments_count;

                        var thread = "<div id=\"panel panel-primary\"><div class=\"panel-body\"><h4>" + title + "</h4>"
                            + "" + description + "</div>"
                            + "<div class=\"panel-footer\"><a id=\"" + threadId + "\" href=\"#\">" + commentsCount + " comments</a></div>"
                            + "</div>";

                        $(".threads").append(thread);
                    }
                }, "json");
        }

        getThreads();

        //if comments is clicked fire the getComments function
        $(".threads").on("click", "a", function(event){
            threadId = event.target.id;

            $.post("php/getThreadComments.php", { "thread_id": threadId },
                function(data) {
                    var comments = "<ul class=\"media-list\">";

                    for (var i in data)
                    {
                        comments += "<li class=\"media\">"
                        + "<div class=\"media-body\">"
                        + data[i].comment
                        + "</div></li>";
                    }

                    comments += "</ul>";
                    $("#" + threadId).after(comments);
                }, "json");
        });
    });