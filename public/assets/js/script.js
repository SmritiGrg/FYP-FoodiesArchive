//DOMContentLoaded - first loads the page then only executes the script
document.addEventListener("DOMContentLoaded", function () {
    // LIKE BUTTON FEATURE
    // gets any click event on the entire page
    document.body.addEventListener("click", function (event) {
        if (
            //checking if the clicked element has the following classes
            event.target.classList.contains("unlike-heart") ||
            event.target.classList.contains("like-heart")
        ) {
            let postId = event.target.getAttribute("data-post-id"); // getting post id from the clicked element
            let likeContainer = event.target.closest("span");

            // select the icons within the same container
            let unlikeHeart = likeContainer.querySelector(".unlike-heart");
            let likeHeart = likeContainer.querySelector(".like-heart");
            let countSpan = likeContainer.querySelector(".like-count");

            // AJAX - sending AJAX request to update the like status
            fetch(`/food-posts/${postId}/like`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json", //JSON FORMAT
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({}),
            })
                .then((response) => {
                    // console.log("Raw response:", response);
                    // Check if the response is a redirect to the login page
                    if (response.redirected) {
                        window.location.href = response.url; // Redirect to the login page
                        return;
                    }

                    // Only parse JSON if the response is valid JSON
                    if (response.status === 401) {
                        window.location.href = "{{ route('login') }}";
                        return;
                    }
                    return response.json(); // Parse the JSON if the response is valid
                })
                .then((data) => {
                    // contains the response from the controller
                    if (data.liked) {
                        //UPDATING UI BASED ON THE RESPONSE LIKE STATUS
                        // User Liked
                        unlikeHeart.classList.add("hidden");
                        likeHeart.classList.remove("hidden");
                        likeHeart.classList.add("active"); // Add the active class for animation

                        // Remove animation after 500ms
                        setTimeout(
                            () => likeHeart.classList.remove("active"),
                            500
                        );
                    } else {
                        // User Unliked
                        likeHeart.classList.add("hidden");
                        unlikeHeart.classList.remove("hidden");
                    }
                    countSpan.textContent = data.likeCount;
                })
                .catch((error) => console.error("Error:", error));
        }
    });
    // END

    // BOOKMARK BUTTON FEATURE
    document.body.addEventListener("click", function (event) {
        if (
            // Checking if the clicked element has the following classes
            event.target.classList.contains("not-bookmarked") ||
            event.target.classList.contains("bookmarked")
        ) {
            // Checking if the clicked element is a bookmark icon
            if (
                event.target.classList.contains("not-bookmarked") ||
                event.target.classList.contains("bookmarked")
            ) {
                let postId = event.target.getAttribute("data-post-id"); // Getting post id from the clicked element
                let bookmarkContainer = event.target.closest("span");

                // Select the bookmark icons within the same container
                let unbookmarkedIcon = bookmarkContainer.querySelector(
                    ".fa-regular.fa-bookmark"
                );
                let bookmarkedIcon = bookmarkContainer.querySelector(
                    ".fa-solid.fa-bookmark"
                );

                // AJAX - sending AJAX request to update the bookmark status
                fetch(`/bookmark/${postId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json", // JSON FORMAT
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify({}),
                })
                    .then((response) => {
                        // Check if the response is a redirect to the login page
                        if (response.redirected) {
                            window.location.href = response.url; // Redirect to the login page
                            return;
                        }

                        // Check for unauthorized status and redirect to login page
                        if (response.status === 401) {
                            window.location.href = "{{ route('login') }}";
                            return;
                        }
                        return response.json(); // Parse the JSON if the response is valid
                    })
                    .then((data) => {
                        // Contains the response from the controller
                        if (data.bookmarked) {
                            // User Bookmarked
                            unbookmarkedIcon.classList.add("hidden");
                            bookmarkedIcon.classList.remove("hidden");
                            bookmarkedIcon.classList.add("active"); // Add the active class for animation

                            // Remove animation after 500ms
                            setTimeout(
                                () => bookmarkedIcon.classList.remove("active"),
                                500
                            );
                        } else {
                            // User Unbookmarked
                            bookmarkedIcon.classList.add("hidden");
                            unbookmarkedIcon.classList.remove("hidden");
                        }
                    })
                    .catch((error) => console.error("Error:", error));
            }
        }
    });
    // END

    // FOR OTHER LIVE SEARCH BAR
    $(document).on("keyup", "#search-bar", function () {
        // console.log("Keyup event fired!");
        var value = $(this).val();
        // console.log(value);
        $.ajax({
            type: "GET",
            url: "/live",
            data: { query: value },
            success: function (data) {
                // console.log(data);
                $("#search-results").html(data);
            },
        });
    });

    // FOR NAV BAR LIVE SEARCH BAR
    $(document).on("keyup", "#nav-search-bar", function () {
        // console.log("Keyup event fired!");
        var value = $(this).val();
        // console.log(value);
        $.ajax({
            type: "GET",
            url: "/live",
            data: { query: value },
            success: function (data) {
                // console.log(data);
                $("#nav-search-results").html(data);
            },
        });
    });

    //REVIEW HELPFUL BUTTON
    document.body.addEventListener("click", function (event) {
        if (
            // Checking if the clicked element has the following classes
            event.target.classList.contains("not-helpful") ||
            event.target.classList.contains("helpful")
        ) {
            // Checking if the clicked element is a bookmark icon
            if (
                event.target.classList.contains("not-helpful") ||
                event.target.classList.contains("helpful")
            ) {
                let reviewId = event.target.getAttribute("data-review-id"); // Getting review id from the clicked element
                let helpfulContainer = event.target.closest("span");

                // Select the bookmark icons within the same container
                let notHelpfulIcon =
                    helpfulContainer.querySelector(".ri-thumb-up-line");
                let helpfulIcon =
                    helpfulContainer.querySelector(".ri-thumb-up-fill");
                let countSpan =
                    helpfulContainer.querySelector(".helpful-count");

                // AJAX - sending AJAX request to update the bookmark status
                fetch(`/review/helpful/${reviewId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json", // JSON FORMAT
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    body: JSON.stringify({}),
                })
                    .then((response) => {
                        // Check if the response is a redirect to the login page
                        if (response.redirected) {
                            window.location.href = response.url; // Redirect to the login page
                            return;
                        }

                        // Check for unauthorized status and redirect to login page
                        if (response.status === 401) {
                            window.location.href = "{{ route('login') }}";
                            return;
                        }
                        return response.json(); // Parse the JSON if the response is valid
                    })
                    .then((data) => {
                        // Contains the response from the controller
                        if (data.helpful) {
                            // User helpful active
                            notHelpfulIcon.classList.add("hidden");
                            helpfulIcon.classList.remove("hidden");
                            helpfulIcon.classList.add("active"); // Add the active class for animation

                            // Remove animation after 500ms
                            setTimeout(
                                () => helpfulIcon.classList.remove("active"),
                                500
                            );
                        } else {
                            // User Unbookmarked
                            helpfulIcon.classList.add("hidden");
                            notHelpfulIcon.classList.remove("hidden");
                        }
                        countSpan.textContent = data.helpfulCount;
                    })
                    .catch((error) => console.error("Error:", error));
            }
        }
    });

    const searchBar = document.getElementById("search-bar");
    const preSearchSuggestions = document.getElementById("pre-search");

    if (searchBar && preSearchSuggestions) {
        searchBar.addEventListener("input", function () {
            if (this.value.trim() !== "") {
                preSearchSuggestions.style.display = "none";
            } else {
                preSearchSuggestions.style.display = "block";
            }
        });
    }
});
