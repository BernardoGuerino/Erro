<!DOCTYPE html>
<html lang="pt-br">
<head>
    
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="Welcome.css">
<title>Login</title>
<style>

body {

background-color: #1b1f27;
font-family: Arial, Helvetica, sans-serif;
overflow: hidden;
}



.arealogin {
display: flex;
height: 100vh;
justify-content: center;
align-items: center;
}

.login {

background-color: #181920;
width: 380px;
height: 345px;
padding: 35px;
align-items: center;
border-radius: 10px;
}


.login form{

display: flex;
flex-direction: column;

}

.login input{

margin-top: 10px;
background-color: #252a34;
padding-left: 10px;
border: none;
height: 45px;
outline: none;
border-radius: 8px;
color: #cbd0f7;

}

input::placeholder{

color: #cbd0f7;
font-size: 14px;
}

form [type="submit"] {
display: block;
background-color: #5568fe;
font-size: 20px;
text-transform: uppercase;
font-weight: bold;
cursor: pointer;
}

p {
color: #cbd0f7;
}

a {
color: #5568fe;
text-decoration: none;
margin-left: 10px;
}

</style>
</head>
<body>
    <section class="arealogin">
        <div class="login">
            <div>
              
            </div>
            <form method="POST">
                <input type="text" name="nome" placeholder="Nome de usuario" autofocus>
                <input type="password" name="senha" placeholder="Senha">
                <input type="submit" value="entrar">
            </form>
            <p>Ainda não tem uma conta?<a href="http://127.0.0.1:8000">Criar conta </p>
        </div>
    </section>

</body>
</html>