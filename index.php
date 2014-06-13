<?php include 'layout/header.php' ?>

<h1>Contas</h1>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th></th>
            <th>Nome</th>
            <th>Cidade</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Tipo</th>
            <th>Dono</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i=0; $i<5; $i++) : ?>
        <tr>
            <td style="text-align: center;"><input type="checkbox"></td>
            <td><a href="account.php">Empresa 123 Ltda</a></td>
            <td>Porto Alegre</td>
            <td>contato@empresa123.com.br</td>
            <td>(51) 3355.2200</td>
            <td><?php echo array('Cliente', 'Prospect')[rand(0,1)] ?></td>
            <td><?php echo array('Jessica', 'John', 'Liza')[rand(0,2)] ?></td>
        </tr>
        <?php endfor; ?>
    </tbody>
    
</table>

<?php include 'layout/footer.php' ?>