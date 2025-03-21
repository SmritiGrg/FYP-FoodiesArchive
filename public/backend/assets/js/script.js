////// SIDEBAR START

document.querySelectorAll(".sidebar-dropdown-toggle").forEach(function (item) {
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
