<?php 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require_once 'Cliente.php';
require_once 'ClienteDAO.php';
require_once 'Livro.php';
require_once 'LivroDAO.php';

$app = AppFactory::create();

$app->addBodyParsingMiddleware();



// INÍCIO
$app->get('/',
    function(Request $request, Response $response, $args) {
        $response->getBody()->write("BEM VINDX À BIBLIOTECA!");
        return $response;
    }
);


// ROTA CLIENTES

// BUSCAR POR MATRÍCULA
$app->get('/clientes/{matricula}',
    function(Request $request, Response $response, $args) {

        $dao = new ClienteDAO;
        $matricula = $args['matricula'];


        $cliente = $dao->buscarMatricula($matricula);
        $payload = json_encode($cliente);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
);


// LISTAR CLIENTES
$app->get('/clientes',
    function(Request $request, Response $response, $args) {
        
        $dao = new ClienteDAO();
        
        $data = $dao->listar();
        $payload = json_encode($data);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
);


// INSERIR CLIENTE
$app->post('/clientes',
    function (Request $request, Response $response, array $args) {

        $data = $request->getParsedBody();
        $cliente = new Cliente(0, $data['nome'], $data['telefone']);

        $dao = new ClienteDAO;
        $cliente = $dao->inserir($cliente);
        $payload = json_encode($cliente);

        $response->getBody()->write($payload);
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
    }
);


// ATUALIZAR CLIENTE
$app->put('/clientes/{matricula}',
    function (Request $request, Response $response, array $args) {
        $matricula = $args['matricula'];
        $data = $request->getParsedBody();
        $cliente = new Cliente($matricula, $data['nome'], $data['telefone']);

        $dao = new ClienteDAO;
        $cliente = $dao->atualizar($matricula, $cliente);

        $payload = json_encode($cliente);

        $response->getBody()->write($payload);
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);    
    }
);



// DELETAR CLIENTE
$app->delete('/clientes/{matricula}',
    function(Request $request, Response $response, $args) {

        $matricula = $args['matricula'];
        $dao = new ClienteDAO();

        $cliente = $dao->deletar($matricula);
        $payload = json_encode($cliente);

        $response->getBody()->write($payload);
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
);



// // ROTA LIVROS

// // BUSCAR POR ID
$app->get('/livros/{id}',
    function(Request $request, Response $response, $args) {

        $dao = new LivroDAO;
        $id = $args['id'];


        $livro = $dao->buscarId($id);
        $payload = json_encode($livro);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
);


// LISTAR LIVROS
$app->get('/livros',
    function(Request $request, Response $response, $args) {
        
        $dao = new LivroDAO();
        
        $data = $dao->listar();
        $payload = json_encode($data);

        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json');
    }
);


// INSERIR LIVRO
$app->post('/livros',
    function (Request $request, Response $response, array $args) {

        $data = $request->getParsedBody();
        $livro = new Livro(0, $data['isbn'], $data['titulo'], $data['autor'], $data['editora'], $data['ano']);

        $dao = new LivroDAO;
        $livro = $dao->inserir($livro);
        $payload = json_encode($livro);

        $response->getBody()->write($payload);
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(201);
    }
);


// ATUALIZAR LIVRO
$app->put('/livros/{id}',
    function (Request $request, Response $response, array $args) {
        $id = $args['id'];
        $data = $request->getParsedBody();
        $livro = new Livro($id ,$data['isbn'], $data['titulo'], $data['autor'], $data['editora'], $data['ano']);

        $dao = new LivroDAO;
        $livro = $dao->atualizar($id, $livro);

        $payload = json_encode($livro);

        $response->getBody()->write($payload);
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);    
    }
);



// DELETAR LIVRO
$app->delete('/livros/{id}',
    function(Request $request, Response $response, $args) {

        $id = $args['id'];
        $dao = new LivroDAO();

        $livro = $dao->deletar($id);
        $payload = json_encode($livro);

        $response->getBody()->write($payload);
        return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
);


$app->run();

?>