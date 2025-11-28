<?php
include('connect.php');
$error = '';
$success = false; // New variable to track success state

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        $check = $conn->prepare("SELECT uid FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();
        
        if ($check->num_rows > 0) {
            $error = "Email already registered.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hashed);
            
            if ($stmt->execute()) {
                // SUCCESS! We set the flag to true instead of redirecting
                $success = true;
            } else {
                $error = "Registration failed.";
            }
            $stmt->close();
        }
        $check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CoreComponents</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <button class="theme-btn" onclick="toggleTheme()" title="Switch Theme">
        <i class="fas fa-adjust"></i>
    </button>

    <div class="glass-container wide-box">
        <img src="images/corecomponents.png" alt="CoreComponents" class="logo-img">
        
        <?php if ($success): ?>

            <div style="text-align: center; padding: 20px;">
                <i class="fas fa-check-circle" style="font-size: 4rem; color: #00C853; margin-bottom: 20px;"></i>
                <h2 style="color: var(--text-main);">Registration Successful!</h2>
                <p class="sub-text">Your account has been created.</p>
                
                <a href="login.php" class="btn-submit" style="text-decoration: none; display: block; width: 100%;">
                    Go to Log In
                </a>
            </div>

        <?php else: ?>

            <h2>Create Account</h2>
            <p class="sub-text">Join us to find the best components.</p>

            <?php if ($error): ?>
                <div class="error-msg"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" novalidate>
                
                <div class="input-group">
                    <label>Full Name</label>
                    <input type="text" name="username" placeholder="John Doe" required>
                </div>

                <div class="input-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="user@example.com" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Create a password" required>
                </div>

                <div class="input-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirmPassword" placeholder="Repeat password" required>
                </div>

                <button type="submit" class="btn-submit">Sign Up</button>
            </form>

            <div class="auth-links">
                <p>Already have an account? <a href="login.php">Log In</a></p>
            </div>

        <?php endif; ?> 
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
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        const tooltip = document.createElement('div');
        tooltip.className = 'custom-tooltip';
        input.parentElement.appendChild(tooltip);
        input.addEventListener('invalid', (e) => {
            e.preventDefault(); 
            tooltip.textContent = input.validationMessage; 
            tooltip.classList.add('active');
        });

        input.addEventListener('input', () => {
            tooltip.classList.remove('active');
        });
    });
    </script>
</body>
</html>