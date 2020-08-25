<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8"/>
    <title>時間割管理</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <a href="/tickets"><h1>時間割登録</h1></a>
    <form method="POST" action="/tickets">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">時間割作成</h2>
                <div class="card-text">
                    <div class="form-group">
                        <label for="subject">曜日</label>
                        <select class="form-control">
                            <option>曜日を選択してください</option>
                            <option>月曜</option>
                            <option>火曜</option>
                            <option>水曜</option>
                            <option>木曜</option>
                            <option>金曜</option>
                        </select>
                        <label for="subject">時間</label>
                        <select class="form-control">
                            <option>時間を選択してください</option>
                            <option>1限</option>
                            <option>2限</option>
                            <option>3限</option>
                            <option>4限</option>
                            <option>5限</option>
                            <option>6限</option>
                            <option>7限</option>
                        </select>
                        <label for="subject">教科名</label>
                        <input type="text" name="subject" id="subject" class="form-control" required>
                        <label for="subject">GoogleClassroomURL</label>
                        <input type="text" name="url" id="url" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <button class="btn btn-primary">作成</button>
            </div>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>