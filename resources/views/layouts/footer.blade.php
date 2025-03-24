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
                    <p class="text-lightgray text-sm font-poppins">
                    Bringing food lovers together, discover authentic tastes, share
                    your Foodie Adventures and stunning foodie spreads today.
                    </p>
                    <p class="text-lightgray text-sm mt-2 font-poppins">
                    Sign up now and discover the best food reviews in Nepal
                    </p>
                </div>

                <div class="w-full sm:w-full md:w-1/3 lg:w-1/5 mt-6">
                    <h3 class="text-gray-900 text-xl font-medium mb-4 font-poppins">
                    Features
                    </h3>
                    <ul class="space-y-2">
                    <li>
                        <a href="#" class="text-lightgray hover:text-gray-500 text-sm hover:underline font-poppins">Create Post</a>
                    </li>
                    <li>
                        <a
                        href="#"
                        class="text-lightgray hover:text-gray-500 text-sm hover:underline font-poppins"
                        >Write Review</a
                        >
                    </li>
                    <li>
                        <a
                        href="#"
                        class="text-lightgray hover:text-gray-500 text-sm hover:underline font-poppins"
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
                        class="text-lightgray hover:text-gray-500 text-sm hover:underline font-poppins"
                        >Discover</a
                        >
                    </li>
                    <li>
                        <a
                        href="#"
                        class="text-lightgray hover:text-gray-500 text-sm hover:underline font-poppins"
                        >Post a food</a
                        >
                    </li>
                    <li>
                        <a
                        href="#"
                        class="text-lightgray hover:text-gray-500 text-sm hover:underline font-poppins"
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
                        class="text-lightgray text-sm font-poppins hover:text-gray-500"
                        >
                        +977 9812354678
                        </li></a
                    >
                    <a href=""
                        ><li
                        class="text-lightgray text-sm font-poppins underline hover:text-gray-500"
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

        ////// SEARCH BAR WHEN SCROLLING JS
        window.addEventListener("scroll", function () {
            let searchBar = document.getElementById("search-bar2");
            if (window.scrollY > 50) {
                searchBar.classList.remove("hidden");
            } else {
                searchBar.classList.add("hidden");
            }
        });
        /////// END


        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                document.getElementById("profilePreview").src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        ///////////// CAROUSEL JS IMAGE
        let currentSlideID = 1;
        const totalSlides = document.getElementById('slider').childElementCount;
        let slideInterval;

        function goToSlide(slideID) {
            currentSlideID = slideID;
            showSlide();
            resetAutoSlide(); 
        }

        function showSlide() {
            const slides = document.getElementById('slider').getElementsByTagName('li');
            const buttons = document.querySelectorAll('.carousel-button');

            // Show the correct slide
            for (let index = 0; index < totalSlides; index++) {
                const element = slides[index];
                if (currentSlideID === index + 1) {
                    element.classList.remove('hidden');
                } else {
                    element.classList.add('hidden');
                }
            }

            // Update button colors
            buttons.forEach((button, index) => {
                if (currentSlideID === index + 1) {
                    button.classList.add('bg-yellow-400');
                    button.classList.remove('bg-gray-400');
                } else {
                    button.classList.add('bg-gray-400');
                    button.classList.remove('bg-yellow-400');
                }
            });
        }

        function nextSlide() {
            currentSlideID = currentSlideID >= totalSlides ? 1 : currentSlideID + 1;
            showSlide();
        }

        function startAutoSlide() {
            slideInterval = setInterval(nextSlide, 4000); // Slide every 4 seconds
        }

        function resetAutoSlide() {
            clearInterval(slideInterval); // Stop the current interval
            startAutoSlide(); // Start a new interval
        }

        // Initialize the carousel
        showSlide();
        startAutoSlide();

    ////////////// END CAROUSELL


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


        document.getElementById("menu-toggle").addEventListener("click", function () {
                document.getElementById("mobile-menu").classList.toggle("hidden");
        });

        //  Modal JavaScript to trigger 
        document.addEventListener("DOMContentLoaded", function() {
            @if(session('showProfileImageModal'))
                document.querySelector('.fixed').classList.remove('hidden');
            @endif
        });

        function closeModal() {
            document.querySelector('.fixed').classList.add('hidden');
        }
        
        ////////////// FOR LIKE button
        // Select the elements
        const unlikeHeart = document.querySelector('.unlike-heart');
        const likeHeart = document.querySelector('.like-heart');

        // Add click event to toggle classes
        unlikeHeart.addEventListener('click', () => {
            unlikeHeart.classList.toggle('active');
            likeHeart.classList.toggle('active');
        });

        likeHeart.addEventListener('click', () => {
            unlikeHeart.classList.toggle('active');
            likeHeart.classList.toggle('active');
        });

        ////////////// FOR BOOKMARK BUTTON
        // Select the elements
        const notBookmarked = document.querySelector('.not-bookmarked');
        const bookmarked = document.querySelector('.bookmarked');

        // Add click event to toggle classes
        notBookmarked.addEventListener('click', () => {
            notBookmarked.classList.toggle('active');
            bookmarked.classList.toggle('active');
        });

        bookmarked.addEventListener('click', () => {
            notBookmarked.classList.toggle('active');
            bookmarked.classList.toggle('active');
        });

        ////// ANIMATE ON SCROLL
        AOS.init({
            duration: 1000,
            once: true,     
        });

        ////// REVIEW SLIDER START
        (function () {
            let currentSlide = 0;
            const reviewCarousel = document.querySelector('#reviewCarousel');
            if (!reviewCarousel) return;

            const slides = reviewCarousel.querySelectorAll('#reviewSlider li');
            const totalSlides = slides.length;
            const buttons = reviewCarousel.querySelectorAll('.review-button');

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('hidden', i !== index);
                });
                updateActiveButton(index);
            }

            function updateActiveButton(index) {
                buttons.forEach((button, i) => {
                    button.classList.toggle('bg-yellow-400', i === index);
                    button.classList.toggle('bg-gray-400', i !== index);
                });
            }

            function reviewGoToSlide(slideIndex) {
                if (slideIndex >= 1 && slideIndex <= totalSlides) {
                    currentSlide = slideIndex - 1;
                    showSlide(currentSlide);
                }
            }

            setInterval(() => {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            }, 5000);

            buttons.forEach((button, index) => {
                button.addEventListener('click', () => reviewGoToSlide(index + 1));
            });

            showSlide(currentSlide);
        })();



        /////// BOOKMARK MODAL
        function openModal() {
            const modal = document.getElementById('foodModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('foodModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }
        //// END BOOKMARK MODAL


        /////// SEARCH BAR MODAL
        function showModal() {
            document.getElementById('search-modal').classList.remove('hidden');
        }

        function hideModal() {
            document.getElementById('search-modal').classList.add('hidden');
        }
        /////// END SEARCH BAR MODAL


        /////// DISCOVER PAGE CATEGORY SCROLLING
        document.getElementById('left-btn').addEventListener('click', function() {
            document.getElementById('sliderCategory').scrollBy({ left: -200, behavior: 'smooth' });
        });
        
        document.getElementById('right-btn').addEventListener('click', function() {
            document.getElementById('sliderCategory').scrollBy({ left: 200, behavior: 'smooth' });
        });
    </script>
</body>

</html>