<footer class="bg-bgPurple">
        <div class="max-w-screen-xl mx-auto">
            <div class="flex flex-wrap p-4 gap-6 justify-between">
                <div class="w-full sm:w-full md:w-1/3 lg:w-1/4 mt-6">
                    <a href="#">
                    <img
                        src="{{ asset('assets/img/FoodiesArchive_Logo-name_only.png') }}"
                        class="h-14 mb-5"
                        alt="Foodie's Archive Logo"
                    />
                    </a>
                    <p class="text-lightgray text-base font-poppins">
                    Bringing food lovers together, discover authentic tastes, share
                    your Foodie Adventures and stunning foodie spreads today.
                    </p>
                    <p class="text-lightgray text-base mt-2 font-poppins">
                    Sign up now and discover the best food reviews in Nepal
                    </p>
                </div>

                <div class="w-full sm:w-full md:w-1/3 lg:w-1/5 mt-6">
                    <h3 class="text-gray-900 text-xl font-medium mb-4 font-poppins">
                    Features
                    </h3>
                    <ul class="space-y-2">
                    <li>
                        <a
                        href="#"
                        class="text-lightgray hover:text-gray-500 text-base hover:underline font-poppins"
                        >Create Post</a
                        >
                    </li>
                    <li>
                        <a
                        href="#"
                        class="text-lightgray hover:text-gray-500 text-base hover:underline font-poppins"
                        >Write Review</a
                        >
                    </li>
                    <li>
                        <a
                        href="#"
                        class="text-lightgray hover:text-gray-500 text-base hover:underline font-poppins"
                        >Build Streaks</a
                        >
                    </li>
                    </ul>
                </div>

                <div class="w-full sm:w-full md:w-1/3 lg:w-1/5 mt-6">
                    <h3 class="text-gray-900 text-xl font-medium mb-4 font-poppins">
                    Quick Links
                    </h3>
                    <ul class="space-y-2">
                    <li>
                        <a
                        href="#"
                        class="text-lightgray hover:text-gray-500 text-base hover:underline font-poppins"
                        >Discover</a
                        >
                    </li>
                    <li>
                        <a
                        href="#"
                        class="text-lightgray hover:text-gray-500 text-base hover:underline font-poppins"
                        >Post a food</a
                        >
                    </li>
                    <li>
                        <a
                        href="#"
                        class="text-lightgray hover:text-gray-500 text-base hover:underline font-poppins"
                        >About us</a
                        >
                    </li>
                    </ul>
                </div>

                <div class="w-full sm:w-full md:w-1/3 lg:w-1/5 mt-6">
                    <h3 class="text-gray-900 text-xl font-medium mb-4 font-poppins">
                    Connect with us
                    </h3>
                    <ul class="space-y-2">
                    <a href=""
                        ><li
                        class="text-lightgray text-base font-poppins hover:text-gray-500"
                        >
                        +977 9812354678
                        </li></a
                    >
                    <a href=""
                        ><li
                        class="text-lightgray text-base font-poppins underline hover:text-gray-500"
                        >
                        foodiearchive@gmail.com
                        </li></a
                    >
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-300 pt-8 text-center pb-5">
                <p class="text-lightgray text-sm font-poppins">
                    This website is developed as a final year project for Informatics
                    College Pokhara, Nepal
                </p>
                <p class="text-lightgray text-sm mt-1 font-poppins">
                    Copyright © 2025 Foodie's Archive. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script>
        setTimeout(function() {
            let message = document.getElementById('success-message');
            if (message) {
                message.style.display = 'none';
            }
        }, 3000); // Hide after 2 seconds

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById("profilePreview").src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        document.addEventListener("DOMContentLoaded", function () {
            const userMenuButton = document.getElementById("user-menu-button");
            const userMenu = document.querySelector('[role="menu"]'); 

            userMenuButton.addEventListener("click", function (event) {
                event.stopPropagation(); 
                userMenu.classList.toggle("hidden");
            });

            // Close menu when clicking outside
            document.addEventListener("click", function (event) {
                if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
                    userMenu.classList.add("hidden");
                }
            });
        });


        document
            .getElementById("menu-toggle")
            .addEventListener("click", function () {
                document.getElementById("mobile-menu").classList.toggle("hidden");
            });
    </script>
</body>

</html>