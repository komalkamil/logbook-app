<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Select Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.3.2/dist/css/tabler.min.css" />

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f7feff;
            color: #141414;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .profile {
            transition: transform .2s;
        }

        .profile:hover {
            transform: scale(1.1);
        }

        .logo {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 60px;
            letter-spacing: 3px;
        }

        .profiles {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .profile {
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .profile:hover {
            transform: scale(1.1);
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 8px;
            object-fit: cover;
            border: 3px solid transparent;
        }

        .profile:hover .avatar {
            border-color: rgb(211, 52, 52);
        }

        .name {
            margin-top: 10px;
            font-size: 16px;
            color: #191919;
        }

        .profile:hover .name {
            color: rgb(12, 12, 12);
        }

        .manage {
            margin-top: 60px;
            padding: 10px 25px;
            border: 1px solid #666;
            color: #aaa;
            background: transparent;
            cursor: pointer;
        }

        .manage:hover {
            color: white;
            border-color: white;
        }
    </style>
</head>

<body>

    <div class="logo"><img src="{{ asset('img/logo-dsi.png') }}" alt="" width="250px"></div>

    <div class="profiles">

        @foreach ($users as $user)
            <div class="profile" data-bs-toggle="modal" data-bs-target="#loginModal"
                data-username="{{ $user->username }}">

                <img class="avatar" src="{{ asset('img/av-' . $user->username . '.jpeg') }}">
                <div class="name">{{ $user->name }}</div>

            </div>
        @endforeach


    </div>



    <div class="modal modal-blur fade" id="loginModal" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center">

                        <img id="avatarPreview" class="avatar avatar-xl mb-3" src="">

                        <h3 id="usernameText"></h3>

                        <input type="hidden" name="username" id="username">

                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary w-100">
                            Login
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.3.2/dist/js/tabler.min.js"></script>


    <script>
        const loginModal = document.getElementById('loginModal')

        loginModal.addEventListener('show.bs.modal', function(event) {

            const button = event.relatedTarget

            const username = button.getAttribute('data-username')

            const usernameInput = loginModal.querySelector('#username')
            const usernameText = loginModal.querySelector('#usernameText')
            const avatarPreview = loginModal.querySelector('#avatarPreview')

            usernameInput.value = username
            usernameText.textContent = username

            avatarPreview.src = "/img/av-" + username + ".jpeg"

        })
    </script>
</body>

</html>



{{-- <h2>Login</h2>


@if ($errors->any())
<div style="color:red;">
    {{ $errors->first() }}
</div>
@endif

<form method="POST" action="/login">
    @csrf

    <label>Username</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<p>Belum punya akun? <a href="/register">Register</a></p> --}}
