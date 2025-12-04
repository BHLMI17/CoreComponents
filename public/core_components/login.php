<?php
session_start();
include('connect.php'); 
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT uid, username, password FROM users WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['uid'] = $user['uid'];
                $_SESSION['username'] = $user['username'];
                header('Location: index.php'); 
                exit();
            } else {
                $errorMessage = "Invalid password.";
            }
        } else {
            $errorMessage = "No account found.";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CoreComponents</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <button class="theme-btn" onclick="toggleTheme()">
        <i class="fas fa-adjust"></i>
    </button>

    <div class="glass-container">
        <img src="images/corecomponents.png" alt="CoreComponents" class="logo-img">
        
        <h2>Welcome Back</h2>
        <p class="sub-text">Enter your credentials to access your account.</p>

        <?php if ($errorMessage): ?>
            <div class="error-msg"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="input-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="e.g. user@example.com" required>
            </div>

            <div class="input-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-submit">Log In</button>
        </form>

        <div class="auth-links">
            <p>Don't have an account? <a href="register.php">Sign Up</a></p>
        </div>
    </div>

    <script>
        const currentTheme = localStorage.getItem('theme');
        if (currentTheme) document.documentElement.setAttribute('data-theme', currentTheme);

        function toggleTheme() {
            const html = document.documentElement;
            if (html.getAttribute('data-theme') === 'light') {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            } else {
                html.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            }
        }
    </script>
    <script>
    // 1. Select all inputs in the form
    const inputs = document.querySelectorAll('input');

    inputs.forEach(input => {
        // 2. Create a hidden tooltip for every input
        const tooltip = document.createElement('div');
        tooltip.className = 'custom-tooltip';
        input.parentElement.appendChild(tooltip);

        // 3. Listen for the "Invalid" event (When user clicks submit but field is empty)
        input.addEventListener('invalid', (e) => {
            e.preventDefault(); // STOP the ugly default browser bubble!
            
            // Show our custom message
            tooltip.textContent = input.validationMessage; // e.g. "Please fill in this field"
            tooltip.classList.add('active');
        });

        // 4. Hide the tooltip as soon as the user starts typing
        input.addEventListener('input', () => {
            tooltip.classList.remove('active');
        });
    });
</script>
</body>
</html>