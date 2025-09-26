<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(colocar nome de usuario)</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

</head>

<style>
    .nome_usuario {
        margin-top: 20px;
        color: #fff;
        position: absolute;
        width: 200px;
    }

    .tipo_dados {
        margin-top: 27px;
        margin-left: 20px;
        color: #fff;
        position: absolute;
        width: 200px;
    }

    .user {
        text-align: center;
        position: relative;
    }

    .profile {
        padding: 8;
        position: absolute;
        top: 60px;
        left: 5%;
        height: 200px;
        width: 200px;
        border: 3px solid #fff;
        border-radius: 50%;
    }

    .profile img {
        height: 190px;
        width: 190px;
        margin-top: 2px;
    }

    .fonteNome {
        font-family: "Poppins", sans-serif;
        font-weight: 300;
    }

    .background_perfil {
        height: 100vh;
        background: linear-gradient(to bottom, #000000 0%, #444654 100%);
        background-repeat: no-repeat;
        position: relative;

    }

    .container_borda {
        border: 2px solid #444654;
        height: 800px;
        border-radius: 20px;
        margin-top: 60px;
        margin-left: 60px;
        margin-right: 150px;
    }

    .col-6.input_nome {
        top: 100px;
        left: 50px;
    }

    .col-2.input_cpf {
        top: 100px;
        left: 50px;
    }

    .col-2.input_rg {
        top: 100px;
        left: 50px;
    }

    .col-2.input_data {
        margin-top: 20px;
        top: 100px;
        left: 50px;
    }

    .col-5.input_email {
        margin-top: 20px;
        top: 100px;
        left: 50px;
    }


    label {
        color: #fff;
    }
</style>

<body>
    <?php
    include_once("menu.php");
    ?>
    <div class="background_perfil">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="user text-center">
                        <div class="profile">
                            <img src="https://i.imgur.com/JgYD2nQ.jpg" class="rounded-circle" name="foto-perfil">
                            <div class="nome_usuario">
                                <h3>Nome usuário</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="container_borda">
                        <div class="tipo_dados">
                            <h3>Dados Pessoais</h3>
                        </div>
                        <form class="needs-validation" novalidate>
                            <div class="row g-3">
                                <div class="col-6 input_nome">
                                    <label for="label-nome" class="form-label">Nome Completo</label>
                                    <input type="text" class="form-control" id="nome" placeholder="Nome completo do usuário" value="" required>
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-2 input_cpf">
                                    <label for="label-cpf" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="cpf" placeholder="Ex.: XXX.XXX.XXX-XX" value="" required>
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-2 input_rg">
                                    <label for="label-rg" class="form-label">RG</label>
                                    <input type="text" class="form-control" id="rg" placeholder="Ex.: XX.XXX.XXX-X" value="" required>
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-2 input_data">
                                    <label for="label-data" class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control" id="data" placeholder="Ex.: 12/10/1996" value="" required>
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                                <div class="col-5 input_email">
                                    <label for="label-email" class="form-label">E-Mail</label>
                                    <input type="email" class="form-control" id="email" placeholder="seu_email@gmail.com" value="" required>
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                            </div>

                            <!--
                             <hr color="#ff0000" size="2" width="50%" align="center" top="100px">    
                            <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Valid last name is required.
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" id="country" required>
                                        <option value="">Choose...</option>
                                        <option>United States</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid country.
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-select" id="state" required>
                                        <option value="">Choose...</option>
                                        <option>California</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" id="zip" placeholder="" required>
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div> -->
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    <?php
    include_once("rodape.php");
    ?>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <script src="checkout.js"></script>
</body>

</html>