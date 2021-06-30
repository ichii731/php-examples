<!DOCTYPE html>
<html>

<head>    
    <meta charset="UTF-8">   

    <meta name="viewport" content="width=device-width, initial-scale=1.0">  

    <meta http-equiv="X-UA-Compatible" content="ie=edge">  
    <title>送信</title>
</head>

<body>  
    <p>POST送信テスト</p>    
    <form action="{{ action('FormController@index') }}" method="POST">    
        @csrf  
        <input type="text" name="post_text" value="" required />      
        <input type="submit" name="submit" value="ページ遷移"  />
</body>

</html>
