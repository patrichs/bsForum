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
                            + description + "</div>"
                            + "<div class=\"panel-footer\"><a id=\"" + threadId + "\" href=\"#\">" + commentsCount
                            + " comments</a> <small>posted on " + dateCreated + "</small></div>"
                            + "</div>"
                            + "<div class=\"comments" + threadId + "\"></div>";

                        $(".threads").append(thread);
                    }
                }, "json");
        }

        getThreads();

        function addReplyArea(threadId)
        {
            var textarea = "<div class=\"row\"><div class=\"col-md-12 form-group\" style=\"margin-top: 5px;\"><textarea class=\"form-control" + "\" rows=\"3\"></textarea>"
                + "<button type=\"button\" class=\"btn btn-primary btn-xs\" style=\"margin-top: 5px;\" data-id=\"" + threadId + "\">reply</button></div></div>";

            $(".comments" + threadId).append(textarea);
        }

        //if comments is clicked fire the getComments function
        $(".threads").on("click", "a", function(event){
            threadId = event.target.id;

            addReplyArea(threadId);

            $.post("php/getThreadComments.php", { "thread_id": threadId },
                function(data) {
                    var comments = "<ul class=\"media-list\">";

                    for (var i in data)
                    {
                        comments += "<li class=\"media\">"
                        + "<div class=\"media-body\"><pre>"
                        + "#" + i + " "
                        + data[i].comment
                        + "</pre></div></li>";
                    }

                    comments += "</ul>";
                    $(".comments" + threadId).append(comments);
                }, "json");

            event.target.remove();
        });

        function addReply($threadId)
        {

        }
    });