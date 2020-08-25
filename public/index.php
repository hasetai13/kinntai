<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require ('/../vendor/autoload.php');

// 各種設定
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = 'localhost';
$config['db']['user']   = 'root';
$config['db']['pass']   = 'vagrant';
$config['db']['dbname'] = 'exampleapp';

$app = new \Slim\App(['settings' => $config]);
$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer('../templates/');

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

// チケットの一覧
$app->get('/tickets', function (Request $request, Response $response, array $args) {
    $sql = 'SELECT * FROM tickets';
    $stmt = $this->db->query($sql);
    $tickets = [];
    while($row = $stmt->fetch()) {
        $tickets[] = $row;
    }
    $data = ['tickets' => $tickets];
    return $this->view->render($response, '/tickets/index.php', $data);
});

// 新規作成用フォームの表示
$app->get('/tickets/create', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, '/tickets/create.php');
});

// チケットの新規作成
$app->post('/tickets', function (Request $request, Response $response, array $args) {
    $subject = $request->getParsedBodyParam('subject');
    //ここに保存処理を書く
    $sql = 'insert into tickets (subject) values (:subject)';
    $stmt = $this->db->prepare($sql);
    $result = $stmt->execute(['subject' => $subject]);
    if(!$result){
        throw new \Exception('coulud not save the tickets');
    }

    //保存が正常にできたら一覧ページへリダイレクトする
    return $response->withRedirect("/tickets");
});

// チケットの表示
$app->get('/tickets/{id}', function (Request $request, Response $response, array $args) {

});

// チケット編集用フォームの表示
$app->get('/tickets/{id}/edit', function (Request $request, Response $response, array $args) {

});

// チケットの更新
$app->patch('/tickets/{id}', function (Request $request, Response $response, array $args) {

});

// チケットの削除
$app->delete('/tickets/{id}', function (Request $request, Response $response, array $args) {

});

$app->run();