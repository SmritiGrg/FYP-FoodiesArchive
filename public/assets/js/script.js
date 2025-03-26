//DOMContentLoaded - first loads the page then only executes the script
document.addEventListener("DOMContentLoaded", function () {
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
});
