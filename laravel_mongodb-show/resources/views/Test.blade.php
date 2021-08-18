<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MongoDB Show</title>
</head>

<body>
    <div>データは全部で{{ count($posts) }}件です。</div><br>
    ※count()関数を用いるとコレクション内のデータの数を出力できます。
    <ul>
        @foreach ($posts as $post)
            <li>{{ '日時:' . $post['date'] . ' | 値:' . $post['body'] }}</li>
        @endforeach
    </ul>

</body>

</html>
