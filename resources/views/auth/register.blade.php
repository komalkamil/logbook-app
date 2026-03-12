<h2>Register</h2>

@if ($errors->any())
    <div style="color:red;">
        {{ $errors->first() }}
    </div>
@endif

<form method="POST" action="/register">
    @csrf

    <label>Nama</label><br>
    <input type="text" name="name" required><br><br>

    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <label>Role</label><br>
    <select name="role" required>
        <option value="admin">Admin</option>
        <option value="pic">Pic</option>
        <option value="op">Operator</option>
    </select><br><br>

    <button type="submit">Register</button>
</form>

<p>Sudah punya akun? <a href="/login">Login</a></p>
