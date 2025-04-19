    <script src="{{asset('backend/assets/js/script.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
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

        // FOR BADGE ADD MODAL FORM
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

        ///// START - FOR EDIT MODAL OF TAG
        function openTagEditModal(id) {
            document.getElementById(`edit-modal-${id}`).classList.remove('hidden');
            document.getElementById(`edit-modal-${id}`).classList.add('flex');
        }

        function closeTagEditModal(id) {
            document.getElementById(`edit-modal-${id}`).classList.remove('flex');
            document.getElementById(`edit-modal-${id}`).classList.add('hidden');
        }
        ///// END - FOR EDIT MODAL OF TAG

        ///// START - FOR EDIT MODAL OF BADGE
        function openBadgeEditModal(id) {
            document.getElementById(`edit-modal-${id}`).classList.remove('hidden');
            document.getElementById(`edit-modal-${id}`).classList.add('flex');
        }

        function closeBadgeEditModal(id) {
            document.getElementById(`edit-modal-${id}`).classList.remove('flex');
            document.getElementById(`edit-modal-${id}`).classList.add('hidden');
        }
        ///// END - FOR EDIT MODAL OF BADGE

        ///// START - FOR EDIT MODAL OF RESTAURANT
        function openRestaurantEditModal(id) {
            document.getElementById(`edit-modal-${id}`).classList.remove('hidden');
            document.getElementById(`edit-modal-${id}`).classList.add('flex');
        }

        function closeRestaurantEditModal(id) {
            document.getElementById(`edit-modal-${id}`).classList.remove('flex');
            document.getElementById(`edit-modal-${id}`).classList.add('hidden');
        }
        ///// END - FOR EDIT MODAL OF RESTAURANT

        ///// START - FOR VIEW MODAL OF RESTAURANT
        function openRestaurantViewModal(id) {
            document.getElementById(`view-modal-${id}`).classList.remove('hidden');
            document.getElementById(`view-modal-${id}`).classList.add('flex');
        }

        function closeRestaurantViewModal(id) {
            document.getElementById(`view-modal-${id}`).classList.remove('flex');
            document.getElementById(`view-modal-${id}`).classList.add('hidden');
        }
        ///// END - FOR VIEW MODAL OF RESTAURANT
    </script>
</body>
</html>