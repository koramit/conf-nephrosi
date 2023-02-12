<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>upload</title>
</head>
<body class="font-k2d text-base">
@if (session('message'))
    <small class="text-green-500">Upload OK</small>
@endif
@error('upload')
    <small class="text-red-400">{{ $errors->upload  }}</small>
@enderror
    <form action="{{ route('upload.store')  }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="upload" class="font-bold">Upload User Excel</label>
        <input type="file" name="upload" id="upload" />
        <button>upload</button>
    </form>
</body>
</html>
