<!DOCTYPE html>
<html>

<head>
    <title>Import Excel</title>
</head>

<body>
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="{{ route('score.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Pilih File Excel:</label>
        <input type="file" name="file" required>
        <button type="submit">Import</button>
    </form>
</body>

</html>
