<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Product</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
  <div id="create">
    <product-form></product-form>
  </div>
  
  @vite(['resources/js/app.js'])
</body>
</html>

