<?php include 'layout/header.php' ?>

<h1>Conta: Empresa 123 Ltda</h1>

<table class="table">
    <tbody>
        <tr>
            <td>Tipo</td>
            <td>Cliente</td>
        </tr>
        <tr>
            <td>Nome</td>
            <td>Empresa 123 Ltda</td>
        </tr>
        <tr>
            <td>Estado</td>
            <td>Rio Grande do Sul</td>
        </tr>
        <tr>
            <td>Cidade</td>
            <td>Porto Alegre</td>
        </tr>
        <tr>
            <td>Bairro</td>
            <td>Floresta</td>
        </tr>
        <tr>
            <td>Endereço</td>
            <td>Av. Cristovão Colombo, 1350/Sala 999</td>
        </tr>
        <tr>
            <td>Telefone</td>
            <td>(51) 3322.0022</td>
        </tr>
    </tbody>
    
</table>

<h2>Contatos</h2>

<table class="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Função</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="contact.php">Juliano</a></td>
            <td>(51) 9911.0022</td>
            <td>juliano@empresa123.com.br</td>
            <td>CEO</td>
        </tr>
        <tr>
            <td><a href="contact.php">Adilson</a></td>
            <td>(51) 9000.0022</td>
            <td>adilson@empresa123.com.br</td>
            <td>Desenvolvedor</td>
        </tr>
    </tbody>
</table>

<h2>Oportunidades</h2>

<table class="table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Conta</th>
            <th>Valor</th>
            <th>Dono</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><a href="opportunity.php">Projeto de e-commerce</a></td>
            <td>Empresa 1</td>
            <td>R$14.000</td>
            <td><a href="#">Igor</a></td>
        </tr>
        <tr>
            <td><a href="opportunity.php">Website institicional</a></td>
            <td>Empresa 2</td>
            <td>R$6.000</td>
            <td><a href="#">Hyan</a></td>
        </tr>
    </tbody>
</table>

<?php include 'layout/footer.php' ?>