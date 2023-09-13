<?php

require_once 'conexao.php';

$stmt1 = $pdo->prepare("
    SELECT * FROM lutador
");

$stmt2 = $pdo->prepare("
    SELECT
        (SELECT COUNT(*) FROM lutador) AS total_lutadores,
        (SELECT AVG(altura) FROM lutador) AS media_alturas,
        (SELECT MAX(altura) FROM lutador) AS maior_altura,
        (SELECT MAX(peso) FROM lutador) AS maior_peso
");

$stmt1->execute();
$stmt2->execute();


function gerarLinhasThead() {
    echo '<thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Peso</th>
                <th>Altura</th>
                <th></th>
                <th></th>
            </tr>
        </thead>';
}

function gerarLinhasTbody($stmt1) {
    echo '<tbody>'; 
    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['nome'] . "</td>";
        echo "<td>" . $row['idade'] . "</td>";
        echo "<td>" . $row['peso'] . "</td>";
        echo "<td>" . $row['altura'] . "</td>";
        echo '<td>
                <a href="editar.php?id=' . $row['id'] . '" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                </td>';
        echo '<td>
                <a href="index2.php?id=' . $row['id'] . '" class="btn btn-danger"><i class="bi bi-archive"></i></a>
                </td>';
        echo "</tr>";
    }
    echo '</tbody>';
}

function gerarLinhasTfoot($totalLutadores, $mediaAlturas, $maiorAltura, $maiorPeso) {
    echo '<tfoot>
            <tr>
                <td colspan="3">Número total de lutadores: ' . $totalLutadores . '</td>
                <td>Média de alturas: ' . $mediaAlturas . '</td>
                <td>Maior altura: ' . $maiorAltura . '</td>
                <td>Maior peso: ' . $maiorPeso . '</td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>';
}

$infoEstatisticas = $stmt2->fetch(PDO::FETCH_ASSOC);
$totalLutadores = $infoEstatisticas['total_lutadores'];
$mediaAlturas = $infoEstatisticas['media_alturas'];
$maiorAltura = $infoEstatisticas['maior_altura'];
$maiorPeso = $infoEstatisticas['maior_peso'];

gerarLinhasThead();
gerarLinhasTbody($stmt1);
gerarLinhasTfoot($totalLutadores, $mediaAlturas, $maiorAltura, $maiorPeso);



?>