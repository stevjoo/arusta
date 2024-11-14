<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
</head>
<body>
    <h1> Contact Us</h1>
    @if(Session::has('msg'))
        <p>{{Session::get('msg')}}</p>  <!--from ContactFormController.php-->
    @endif
    
    <form method="post" id="contact-form" name="contact_form" action="/post-message">
        @csrf 
        <p>Name: </p>
        <input name="name" id="formName" type="text">
        <p>Email: </p>
        <input name="email" id="formEmail" type="text">
        <p>Phone: </p>
        <input name="phone" id="formPhone" type="text">
        <p>title: </p>
        <input name="title" id="formTitle" type="text">
        <p>Message: </p>
        <input name="message" id="formMessage" type="text">
        <button type="submit">
            send message
        </button>
    </form>
</body>
</html>