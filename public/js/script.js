$(document).ready(function () {
    var projectDelete = $(".project .delete-button");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(projectDelete).on("click", function () {
        var projectId = $(this).attr("data-project-id");
        $.ajax({
            type: 'POST',
            url: '/deleteproject',
            data: {
                projectId: projectId
            },
            success: function (data) {
                alert('Projekt został usunięty');
                $(location).attr("href", "/panel");
            }
        });
    });

    var logoutButton = $(".logout-button");
    $(logoutButton).on("click", function () {
        $.ajax({
            type: 'POST',
            url: '/logout',
            success: function () {
                $(location).attr("href", "/");
            }
        });
    });

    var getProject = $(".get-project");
    $(getProject).on("click", function () {
        var projectId = $(this).attr("data-project-id");
        $.ajax({
            type: 'POST',
            url: '/project',
            data: {
                projectId: projectId
            },
            success: function () {
                $(location).attr("href", "/project");
            }
        });
    });

    var projectImage = $(".project-image > img");
    $(projectImage).on("click", function (e) {
        var top = e.pageY - $(this).offset().top;
        var left = e.pageX - $(this).offset().left;
        var commentForm = "<form method='post' class='comment-form' style='position: absolute; top:" + top + "px; left:" + left + "px'><textarea name='comment'>comment</textarea><br><input type='submit' value='Add comment'></form>";
        var commentForms = $(".comment-form");

        if ($(commentForms).length > 0) {
            $(commentForms).remove();
        } else {
            $(this).parent().append(commentForm);
            $(".comment-form > input").on("click", function (el) {
                el.preventDefault();
                var comment = $(".comment-form textarea").text();
                $.ajax({
                    type: 'POST',
                    url: '/addDiscussion',
                    data: {
                        posTop: top,
                        posLeft: left,
                        comment: comment
                    },
                    success: function (data) {
                        console.log(data.discussions);
                        var newDiscuss = [];
                        for (let i = 0; i < data.discussions.length; i++) {
                            newDiscuss.push('<div class="project-discussion" style="left:' + data.discussions[i].pos_left + 'px; top:' + data.discussions[i].pos_top + 'px;">' + (data.discussions.length - i) + '</div>');
                        }
                        let newDiscussJoin = newDiscuss.join("");
                        console.log(newDiscussJoin);
                        $(".comment-form").remove();
                        $(".project-discussion").remove();
                        $(".project-image").append(newDiscussJoin);
                    }
                });
            });
        }
    });
    
    var showDiscuss = $(".project-discussion");
    $(showDiscuss).on("click", function (e) {
        var top = e.pageY;
        var left = $(this).parent - e.pageX;
        console.log(top + " " + left);
        var commentForm2 = "<div class='comment-form-2' style='position: absolute; top:" + top + "px; left:" + left + "px'><form method='post'><textarea name='comment'>comment</textarea><br><input type='submit' value='Add comment'></form></div>";
        let commentForms2 = $(".comment-form-2");
        //if ($(commentForms2).length > 0) {
            $(commentForms2).remove();
        //} else {
            $(this).parent().append(commentForm2);
        //}
    });
});