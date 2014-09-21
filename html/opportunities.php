<?php include 'layout/header.php' ?>

<h1>Oportunidades</h1>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Conta</th>
            <th>Valor</th>
            <th>Dono</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i=0; $i<5; $i++) : ?>
        <tr>
            <td style="text-align: center;"><input type="checkbox"></td>
            <td><a href="opportunity.php">Projeto de e-commerce</a></td>
            <td><a href="account.php">Empresa 123 Ltda</a></td>
            <td>R$ 15.000</td>
            <td><?php echo array('Jessica', 'John', 'Liza')[rand(0,2)] ?></td>
        </tr>
        <?php endfor; ?>
    </tbody>
    
</table>

<?php include 'layout/footer.php' ?>
