<?php

// Conexão ao banco de dados
require 'config.php';

// Defina a quantidade de registro por paginas
$qtRegistroPg = 3;

// Query para saber a quantidade total de registros
$sql = $pdo->query("SELECT COUNT(*) as c FROM blog");
$sql = $sql->fetch();
$total = $sql['c'];

// Calcular quantidade de paginas de acordo a quantidade total de registro
$paginas = $total / $qtRegistroPg;

// Por padrão é definido sempre a pagina 1
$pg = 1;

// Vefifica se foi definido outros pagina
if( isset($_GET['p']) && !empty($_GET['p']) ) {
    
    // Aplica proteção de sql-inject
    $pg = addslashes($_GET['p']);
    
    // Converte para int, assim se o usuario editar a url não vai quebra o código
    $pg = intval($pg);
    
    // Caso a pagina será 0, ou seja o usuario modificou a url eu irei dizer que a pagina é 1 para não quebrar o código
    if( $pg == 0 ) {
        $pg = 1;
    }

    // Casa seja modificado na url para um numero maior que a quantidade de paginas é mostrado a ultima pagina
    if( $pg > $paginas ) {
        $pg = $paginas;
    }
}

// Define o valor inicial para query
$p = ($pg - 1) * $qtRegistroPg;

// Quary para pegar apenas os registro que terei que exibir
$sql = $pdo->query("SELECT * FROM blog LIMIT $p, $qtRegistroPg");

// Vefifica se tem registro para mostrar
if( $sql->rowCount() > 0 ){
    
    // Loop na quantidade de resgitros para mostrar resultados
    foreach( $sql->fetchAll() as $item ) {
        echo $item['id'].' - '.$item['title'].'<br/>';
    }

}

// Quebra de linha horizontal
echo '<hr/>';

// Criação dos links para navegar por as paginas
for( $q=0; $q<$paginas; $q++ ) {
    echo '<a href="./?p='.($q+1).'">['.($q+1).']</a>';
}