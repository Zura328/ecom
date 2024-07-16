<html>
<head>
    <title>Upload CSV</title>
</head>
<body>
    <h1>Upload CSV File</h1>
    <form action="/upload-csv/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="csv_file" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>