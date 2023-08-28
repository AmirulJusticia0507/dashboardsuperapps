<?php
// Include koneksi.php
include 'koneksi.php';
// include 'theme/header.php';

// Fungsi untuk mengenkripsi password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Fungsi untuk memeriksa apakah email sudah terdaftar
function isEmailExists($email) {
    global $koneksiku;
    $query = "SELECT user_id FROM users WHERE email = ?";
    $stmt = $koneksiku->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows > 0;
}

// Fungsi untuk menambahkan user baru
function addUser($username, $email, $password, $role) {
    global $koneksiku;
    $passwordHash = hashPassword($password);
    $query = "INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)";
    $stmt = $koneksiku->prepare($query);
    $stmt->bind_param("ssss", $username, $email, $passwordHash, $role);
    return $stmt->execute();
}

// Mengambil data dari form jika ada yang disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = "Customer"; // Set role sesuai dengan kebutuhan (di sini defaultnya Customer)

    if (!isEmailExists($email)) {
        if (addUser($username, $email, $password, $role)) {
            echo "User berhasil terdaftar!";
        } else {
            echo "Gagal mendaftarkan user.";
        }
    } else {
        echo "Email sudah terdaftar.";
    }
}
?>
<style>
    
</style>
<div class="flex-wrap">
    <fieldset>
        <form action="" method="post" novalidate>
            <input type="radio" name="rg" id="sign-in" checked />
            <input type="radio" name="rg" id="sign-up" />
            <input type="radio" name="rg" id="reset" />

            <label for="sign-in">Sign in</label>
            <label for="sign-up">Sign up</label>
            <label for="reset">Reset</label>

            <input class="sign-up sign-in reset" type="email" name="email" placeholder="Email" required />
            <input class="sign-up sign-in" type="password" name="password" placeholder="Password" required />
            <input class="sign-up" type="password" placeholder="Repeat Password" required />
            <button type="submit">Submit</button>

            <p>In response to <a href="https://codepen.io/IanHazelton/details/bgwEPa/" target="_blank">this pen</a></p>
        </form>
    </fieldset>
</div>
