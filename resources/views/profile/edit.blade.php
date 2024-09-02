<!-- resources/views/profile/edit.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Edit Profile</h2>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title"> <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" /> {{ Auth::user()->name }}</h5>
            <img class="card-img-top" src="{{ asset('storage/userPictures/' . Auth::user()->profile_pic) }}" style="width: 120px; height:120px; " alt="No profile to display"/>
            <p class="card-text"> <i class="fa fa-envelope"></i> <strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p class="card-text"> <i class="fa fa-envelope"></i> <strong>Role:</strong> {{ Auth::user()->role }}</p>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Profile Picture -->
        <div class="mb-3">
            <label for="profile_picture" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
        </div>

        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
    </div>
    <br>
    <a href="{{ url('/employees') }}" class="btn btn-secondary">Back</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
