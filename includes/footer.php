<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get references to forms and links
            var loginForm = document.getElementById('loginForm');
            var registerForm = document.getElementById('registerForm');
            var createAccountLink = document.getElementById('createAccountLink');
            var backToLoginLink = document.getElementById('backToLoginLink');

            // Handle click on "Create new account" link
            createAccountLink.addEventListener('click', function(e) {
                e.preventDefault();
                loginForm.style.display = 'none';
                registerForm.style.display = 'block';
            });

            // Handle click on "Back to login" link
            backToLoginLink.addEventListener('click', function(e) {
                e.preventDefault();
                registerForm.style.display = 'none';
                loginForm.style.display = 'block';
            });
        });
    </script>
</body>
</html>