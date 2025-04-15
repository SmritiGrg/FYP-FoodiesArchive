    <script src="{{asset('backend/assets/js/script.js')}}"></script>
    <script>
        setTimeout(function() {
            let message = document.getElementById('success-message');
            if (message) {
                message.style.display = 'none';
            }
        }, 3000); // Hiding after 2 seconds

        // FOR RESTAURANT ADD MODAL FORM
        function openRestaurantModal() {
            document.getElementById('restaurantModal').classList.remove('hidden');
            document.getElementById('restaurantModal').classList.add('flex');
        }

        function closeRestaurantModal() {
            document.getElementById('restaurantModal').classList.remove('flex');
            document.getElementById('restaurantModal').classList.add('hidden');
        }

        // FOR TAG ADD MODAL FORM
        function openTagModal() {
            document.getElementById('tagModal').classList.remove('hidden');
            document.getElementById('tagModal').classList.add('flex');
        }

        function closeTagModal() {
            document.getElementById('tagModal').classList.remove('flex');
            document.getElementById('tagModal').classList.add('hidden');
        }

        // FOR BADGE ADD MODAL FORM
        function openBadgeModal() {
            document.getElementById('badgeModal').classList.remove('hidden');
            document.getElementById('badgeModal').classList.add('flex');
        }

        function closeBadgeModal() {
            document.getElementById('badgeModal').classList.remove('flex');
            document.getElementById('badgeModal').classList.add('hidden');
        }
    </script>
</body>
</html>