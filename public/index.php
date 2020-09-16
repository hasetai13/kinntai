<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require ('../vendor/autoload.php');

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

// 新規アカウント作成フォームの表示
$app->get('/board/sighnin', function (Request $request, Response $response, array $args) {
    $sql = 'SELECT * FROM tickets';
    $stmt = $this->db->query($sql);
    $tickets = [];
    while($row = $stmt->fetch()) {
        $tickets[] = $row;
    }
    $data = ['tickets' => $tickets];
    return $this->view->render($response, '/tickets/index.php', $data);
});

// ログインフォームの表示
$app->get('/tickets/create', function (Request $request, Response $response, array $args) {
    return $this->view->render($response, '/tickets/create.php');
});

// トップページの表示
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



///////////以下新規ファイル//////////////////
////$app->get('/tickets/create', function (Request $request, Response $response, array $args) {
//    return $this->view->render($response, '/tickets/create.php');
//});



// 新規アカウント作成フォームの表示
$app->get('/board/register', function (Request $request, Response $response, array $args) {
    //print ("新規作成フォームの表示");
    return $this->view->render($response, '/board/register.html');
});

// ログインフォームの表示
$app->get('/board/login', function (Request $request, Response $response) {
    //$response->getBody()->write('店長側：ログイン画面');
    return $this->view->render($response, '/board/login.html');
    return $response;
});

// トップページの表示
$app->get('/board/top', function (Request $request, Response $response) {
    //$response->getBody()->write('店長側：トップページ');
    return $this->view->render($response, '/board/top.html');
    return $response;
});

// 従業員一覧ページの表示
$app->get('/board/employees', function (Request $request, Response $response) {
    //$response->getBody()->write('店長側：従業員一覧画面');
    return $this->view->render($response, '/board/employees.html');
    //return $response;
});

// 月末処理ページの表示
$app->get('/board/process', function (Request $request, Response $response) {
    $response->getBody()->write('店長側：月末処理：開発中');
    return $this->view->render($response, '/board/404.html');
    //return $this->view->render($response, '/board/prosessing.html');
});

// システム設定ページの表示
$app->get('/board/settings', function (Request $request, Response $response) {
    $response->getBody()->write('店長側：システム設定');
    return $this->view->render($response, '/board/404.html');
    //return $this->view->render($response, '/board/setting.html');
});

$app->run();