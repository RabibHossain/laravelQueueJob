<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Million Records</title>
</head>
<body>
<form action="/data-upload" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="csvFile" id="csvFile">
    <input type="submit" value="Submit">
</form>
</body>
</html>
