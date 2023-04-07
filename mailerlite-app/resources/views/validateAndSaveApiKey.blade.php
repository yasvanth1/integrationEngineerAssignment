<!DOCTYPE html>
<html>
<head>
    <title>Validate API Key</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
            margin-top: 40px;
            margin-bottom: 30px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type=text] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
        }

        button[type=submit] {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button[type=submit]:hover {
            background-color: #0069d9;
        }

        p{
            text-align:center; color:crimson;
        }
    </style>
</head>
<body>
    <h1>Validate API Key</h1>
    
    @if (isset($error))
        <p>{{ $error }}</p>
    @endif

    <form method="GET" action="/">
        <div>
            <label for="api-key">API Key:</label>
            <input type="text" id="api-key" name="api-key">
        </div>
        <button type="submit" name="validate">Validate</button>
    </form>
</body>
</html>