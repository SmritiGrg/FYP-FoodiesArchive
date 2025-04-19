//DOMContentLoaded - first loads the page then only executes the script
document.addEventListener("DOMContentLoaded", function () {
    ////// SIDEBAR START
    document
        .querySelectorAll(".sidebar-dropdown-toggle")
        .forEach(function (item) {
            item.addEventListener("click", function (e) {
                e.preventDefault();
                const parent = item.closest(".group");
                if (parent.classList.contains("selected")) {
                    parent.classList.remove("selected");
                } else {
                    document
                        .querySelectorAll(".sidebar-dropdown-toggle")
                        .forEach(function (i) {
                            i.closest(".group").classList.remove("active");
                        });
                    parent.classList.add("selected");
                }
            });
        });
    ////// SIDEBAR END

    $(document).on("keyup", "#search", function () {
        // alert("hello");
        $value = $(this).val();
        if ($value) {
            $(".alldata").hide();
            $(".searchdata").show();
        } else {
            $(".alldata").show();
            $(".searchdata").hide();
        }
        $.ajax({
            type: "GET",
            url: "/search-badge",
            data: { search: $value },

            success: function (data) {
                console.log(data);
                $("#badge-content").html(data);
            },
        });
    });

    $(document).on("keyup", "#searchtag", function () {
        // alert("hello");
        $value = $(this).val();
        if ($value) {
            $(".alldatatag").hide();
            $(".searchdatatag").show();
        } else {
            $(".alldatatag").show();
            $(".searchdatatag").hide();
        }
        $.ajax({
            type: "GET",
            url: "/search-tag",
            data: { search: $value },

            success: function (data) {
                console.log(data);
                $("#tag-content").html(data);
            },
        });
    });
});
