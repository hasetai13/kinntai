<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8"/>
    <title>時間割管理</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <h1>時間割一覧</h1>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">時間割一覧</h2>
            <div class="card-text">
                <ul class="list-group">
                    <?php foreach ($tickets as $ticket): ?>
                        <li class="list-group-item"><?= htmlspecialchars($ticket['subject'], ENT_QUOTES, 'UTF-8', false) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="card-body">
                <a href="/tickets/create"><button class="btn btn-primary">作成</button></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>