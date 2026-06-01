<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Code Generator</title>
    <style>
        body {
            font-family: Arial;
            text-align: center;
            margin-top: 100px;
        }
        input, button {
            padding: 10px;
            margin: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<h1>Create Admin Access Code</h1>

<input type="text" id="code" placeholder="Enter access code">
<br>
<button onclick="submitCode()">Save Code</button>

<p id="response"></p>

<script>
function submitCode() {
    const code = document.getElementById("code").value;

    if (!code) {
        document.getElementById("response").innerText = "Please enter a code.";
        return;
    }

    fetch("save_code.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "code=" + encodeURIComponent(code)
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById("response").innerText = data;
    })
    .catch(err => {
        document.getElementById("response").innerText = "Error saving code.";
    });
}
</script>

</body>
</html>