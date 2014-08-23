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

        function getComments(threadid)
        {
            $.post("php/getThreadComments.php",
                function(data) {
                    for (var i in data)
                    {
                        var thread = "<h4>" + data[i].title + " <a id=\"" + data[i].id + "\" href=\"#\"><small>view comments</small></a></h4>"
                            + "<p>" + data[i].description + "</p>"
                            + "<br>";

                        $(".threads").append(thread);
                    }
                }, "json");
        }
    });