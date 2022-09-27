Cadastro

No cadastro vai ter que ter um formulario com id de "CadUsuario"
Ai vão ter 5 inputs nele (nome/email/senha/confirmar_senha/submit):
Nome: vai ser um input com type "text" e name "CadNome"
Email: vai ser um input com type "email" e name "CadEmail"
Senha: vai ser um input com type "password" e name "CadSenha"
Confirmar_senha: vai ser um input com type "password" e name "CadSenhaconf"
Submit: vai ser um input com type "submit"

Ai vai ficar assim:
<form id="CadUsuario">
	<input type="text" name="CadNome">
	<input type="email" name="CadEmail">
	<input type="password" name="CadSenha">
	<input type="password" name="CadSenhaconf">
	<input type="submit">
</form>

Login:
No login vai ter que ter um formulario com id de "LogUsuario"
Ai vão ter 2 inputs nele (email/senha/submit):
Email: vai ser um input com type "text" e name "LogEmail"
Senha: vai ser um input com type "password" e name "LogSenha"

Ai vai ficar assim:
<form id="LogUsuario">
	<input type="email" name="LogEmail">
	<input type="password" name="LogSenha">
	<input type="submit">
</form>

Obs: se quiser adicionar labels, id, classes, values em qualquer um dos 2 formularios pode, eu so colequei o que tem que ser obrigatorio.

              <form id="FBUsuario">
                <label for="caixaFB" id="coment_fb">Deixe sua nota e comentário:</label>
                <select name="score" required>
                  <option value="1"> 1 </option>
                  <option value="2"> 2 </option>
                  <option value="3"> 3 </option>
                  <option value="4"> 4 </option>
                  <option value="5" selected="selected"> 5 </option>
                </select>
                <input type="text" name="caixaFB" required>
                <label id="msg-fb"></label>
                <input type="submit" class="btn btn-success" id="btn-SubmitFB" value="Enviar" />
              </form>