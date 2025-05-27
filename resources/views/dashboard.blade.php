<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <h1>Welcome to the Dashboard</h1>
        <h1>Hi, {{ $user->name }}</h1>
        <p>You are logged in!</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> 
            @if ($user->role == 1)
                You are Admin
            @elseif ($user->role == 2)
                You are Teacher
            @elseif ($user->role == 3)
                You are Staff
            @else
                Unknown Role ({{ $user->role }})
            @endif
        </p>
        <button class="btn btn-danger mb-3">
            <a href="{{ route('logout') }}" class="text-decoration-none text-white">Logout</a>
        </button>

        
        @if($user->role == 1)
            <div class="row">
                <div class="col-6">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <h2>Add User</h2>
                    <form action="{{ route('admin.storeUser') }}" method="post">
                        @csrf
                        <input type="text" name="name" class="form-control mb-2" value="{{ old('name') }}" placeholder="Name" required>
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror

                        <input type="email" name="email" class="form-control mb-2" value="{{ old('email') }}" placeholder="Email" required>
                        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                        
                        <input type="password" name="password" class="form-control mb-2" value="{{ old('password') }}" placeholder="Password" required>
                        @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                        
                        <select class="form-select mb-2" name="user_role" aria-label="Default select example">
                            <option disabled selected>User type</option>
                            <option value="2">Teacher</option>
                            <option value="3">Staff</option>
                        </select>
                        @error('user_role') <div class="text-danger">{{ $message }}</div> @enderror

                        <button class="btn btn-warning" type="submit">Submit</button>
                    </form>
                </div>

                <div class="col-6">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Role</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $userData as $users)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $users->name }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td> 
                                        @if($users->role == 1) 
                                            Admin 
                                        @elseif($users->role == 2) 
                                            Teacher 
                                        @elseif($users->role == 3) 
                                            Staff 
                                        @endif 
                                    </td>
                                    <td>
                                        <Button class="btn btn-small btn-danger">Delete</Button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>