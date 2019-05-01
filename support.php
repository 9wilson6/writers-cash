<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
font-family: Arial, Helvetica, sans-serif;
}

* {
box-sizing: border-box;
}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
background-color: #126D91;
color: white;
padding: 7px 10px;
border: none;
cursor: pointer;
opacity: 0.8;
position: fixed;
bottom: 1px;
right: 15px;
width: 280px;
text-align: center;
}

/* The popup chat - hidden by default */
.chat-popup {
display: none;
position: fixed;
bottom: 0;
right: 15px;
border: 3px solid #f1f1f1;
z-index: 9;
}

/* Add styles to the form container */
.form-container {
max-width: 300px;
padding: 10px;
background-color: white;
}

/* Full-width textarea */
.form-container textarea {
width: 100%;
padding: 15px;
margin: 5px 0 22px 0;
border: none;
background: #fff;
resize: none;
height: 80px;
font-size: 15px;

}

/* When the textarea gets focus, do something */
.form-container textarea:focus{
background-color: #fff;
outline: none;
}
.form-container textarea:invalid{
background-color: #fff;
outline: none;
}

/* Set a style for the submit/send button */
.form-container .my_btn {
background-color: #4CAF50;
color: white;
padding: 7px 10px;
border: none;
cursor: pointer;
width: 100%;
margin-bottom: 10px;
opacity: 0.8;
font-size: 14px;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
font-weight: bolder;
padding: 10px;
cursor: pointer;
position: absolute;
right: 10px;
top: 0px;
color: red;

}

/* Add some hover effects to buttons */
.form-container .my_btn:hover,
.open-button:hover {
opacity: 1;
}
.unread{
	background: #0092C8;
	padding-top: 7px;
	color: #fff;
	position: absolute;
	right: 10px;
	top: 3px;
	height: 40px;
	width: 40px;
	border-radius: 20px;
	font-size: 14px;
	font-weight: bolder;
}
#showmessage{
	height: 250px;
	width: 100%;
	background: #E2E3E5;
	overflow-y: auto;
	font-size: 13px;
	padding: 10px;

}
.sent, .received{
	width: 90%;
	margin-bottom: 10px;
	padding: 10px;
	border-radius: 10px;

}
.sent{
float: right;
clear: both;
background: #F8F9FA;

}
.received{
float: left;
clear: both;
background: #F5F7FB;
}
.datetym{
	display: block;
	color: #18376E;
	float: right;
	font-size: 10px;
	font-style: italic;
	font-weight: lighter;
}
</style>
</head>

<body>


<div class="open-button" onclick="openForm()">Contact support <span class="unread">0</span></div>

<div class="chat-popup" id="myForm">
<form action="" method="POST" id="form" class="form-container" >
	
	<label for="msg"><b>Messages</b></label> <span class="cancel" onclick="closeForm()">X</span>
	<div id="showmessage"></div>

<textarea placeholder="Type message.." name="msg" required id="message"></textarea>

<input type="submit" class="my_btn" value="Send">

</form>
</div>
<script>
let user_id=<?php echo $_SESSION['user_id']; ?>;
	let user_type=<?php echo $_SESSION['user_type']; ?>;
function openForm() {
document.getElementById("myForm").style.display = "block";
$('#showmessage').stop().animate({ scrollTop: $('#showmessage')[0].scrollHeight});
$.post("../support_",
	{
	user_id:user_id,
	user_type:user_type,
	update:"update"	
	});
}

function closeForm() {
document.getElementById("myForm").style.display = "none";
}

$(document).ready(function(){

$("#form").submit(function(e){
	e.preventDefault();

	let message=$("#message").val();
	$("#message").val("");

	$.post("../support_",
	{
	message:message,
	user_id:user_id,
	user_type:user_type,
	submit:"submit"	
	});
	$('#showmessage').stop().animate({ scrollTop: $('#showmessage')[0].scrollHeight});
});	


setInterval(function(){
$("#showmessage").load("../support_",
	{
	user_id:user_id,
	user_type:user_type,
	getdata:"getdata"	
	});
$(".unread").load("../support_",
	{
	user_id:user_id,
	user_type:user_type,
	count:"getdata"	
	});
}, 200);

});
</script>

</body>

</html>

