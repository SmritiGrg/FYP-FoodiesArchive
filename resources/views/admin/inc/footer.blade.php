    <script src="{{asset('backend/assets/js/script.js')}}"></script>
    <script>
        setTimeout(function() {
            let message = document.getElementById('success-message');
            if (message) {
                message.style.display = 'none';
            }
        }, 3000); // Hiding after 2 seconds

        // FOR RESTAURANT ADD MODAL FORM
        function openModal() {
            document.getElementById('restaurantModal').classList.remove('hidden');
            document.getElementById('restaurantModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('restaurantModal').classList.remove('flex');
            document.getElementById('restaurantModal').classList.add('hidden');
        }
    </script>
</body>
</html>