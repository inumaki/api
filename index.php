<html>
<head>
<title>My Application</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">    
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body onload="fetch_guests();">
<div class="w3-container">
<h1 style="text-align:center;">My AJAX Application <br/><small><small><small><button onclick="add_new_guest();" class="w3-btn w3-yellow">Add New Guest</button></small></small></small></h1>

<table id="mytable" class="w3-table-all"></table>
</div>
</body>
<script src="myscript.js"></script>
</html>