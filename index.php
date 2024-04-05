<?php
include 'classes/contatos.class.php';
$contato = new Contatos();
?>

<h1>Agenda</h1>
<button> <a href = "adicionarContato.php"> Adicionar </a></button>
<br><br>
<table border ="2" width = 100% > 
    <tr>
      <th>ID </th>
      <th>NOME </th>
      <th>EMAIL </th>
      <th>TELEFONE </th>
      <th>CIDADE </th>
      <th>RUA </th>
      <th>NÚMERO </th>
      <th>BAIRRO </th>
      <th>CEP </th>
      <th>PROFISSÃO </th>
      <th>FOTO </th>
      <th>AÇÕES </th>
    </tr>
    <?php
    $lista = $contato->listar();
    foreach ($lista as $item):
    ?>
    <tbody>
        <tr>
            <td><?php echo $item['id']; ?> </td>
            <td><?php echo $item['nome']; ?> </td>
            <td><?php echo $item['email']; ?> </td>
            <td><?php echo $item['telefone']; ?> </td>
            <td><?php echo $item['cidade']; ?> </td>
            <td><?php echo $item['rua']; ?> </td>
            <td><?php echo $item['numero']; ?> </td>
            <td><?php echo $item['bairro']; ?> </td>
            <td><?php echo $item['cep']; ?> </td>
            <td><?php echo $item['profissao']; ?> </td>
            <td><?php echo $item['foto']; ?> </td>
            <td>
                <a href="editarContato.php?id=<?php echo $item ['id'];?>">EDITAR</a>
                <a href="#">|EXCLUIR</a>
            </td>
        </tr>
    </tbody>
    <?php
    endforeach;
    ?>
</table>


