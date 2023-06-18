<?php
$codigo = filter_input(INPUT_GET, 'codigo');
$nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_SPECIAL_CHARS);
$cpf_cnpj = filter_input(INPUT_POST, "cpf_cnpj", FILTER_SANITIZE_SPECIAL_CHARS);
$cep = filter_input(INPUT_POST, "cep", FILTER_SANITIZE_SPECIAL_CHARS);
$estado = filter_input(INPUT_POST, "estado", FILTER_SANITIZE_SPECIAL_CHARS);
$cidade = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_SPECIAL_CHARS);
$bairro = filter_input(INPUT_POST, "bairro", FILTER_SANITIZE_SPECIAL_CHARS);
$rua = filter_input(INPUT_POST, "rua", FILTER_SANITIZE_SPECIAL_CHARS);
$numero = filter_input(INPUT_POST, "numero", FILTER_SANITIZE_SPECIAL_CHARS);

include_once '../../functions/database.php';
$bd = connection();

$sql = "UPDATE transportadoras SET
            cpf_cnpj_transportadora = '$cpf_cnpj',
            nm_transportadora = '$nome',
            cep_transportadora = '$cep',
            cidade_transportadora = '$cidade',
            estado_transportadora = '$estado',
            bairro_transportadora = '$bairro',
            logradouro_transportadora = '$rua',
            nr_transportadora = '$numero'
        WHERE id_transportadora = '$codigo' ";


$bd->beginTransaction();
$linhas = $bd->exec($sql);
if ($linhas == 1) {
  $bd->commit();
} else {
  $bd->rollBack();
}

$bd = null;

header("location:index.php");
