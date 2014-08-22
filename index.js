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

                        $.post("php/getThreadCommentsCount.php", { "thread_id": data[i].id },
                            function(data) {
                                var thread = "<h4>" + title + " <small>" + dateCreated + "</small></a></h4>"
                                    + "<p>" + description + "</p>"
                                    + "<a id=\"" + threadId + "\" href=\"#\"><small>" + data.commentsCount + " comments</small></a>"
                                    + "<br>";

                                $(".threads").append(thread);
                            }, "json");
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