const CadForm = document.getElementById("CadUsuario");
const LogForm = document.getElementById("LogUsuario");
const FBForm = document.getElementById("FBUsuario");

var prodid;
var user;

//Pegar a pessoa no JS quando site abrir se estiver logado
window.onload = function() {
  let aba = document.getElementById("aba_user");
  if (localStorage.logado) {
    let pessoa = localStorage.getItem('logado').split('/');
    user = {
      iduser: pessoa[0],
      name: pessoa[1],
      email: pessoa[2],
      master: pessoa[3]
    }
    if (aba) {
      if(user.master){
        aba.innerHTML = `<a href="admin.php">Olá, ${user.name}</a>`; 
      } else {
       aba.innerHTML = `Olá, ${user.name}`; 
      }
    }
  } else {
    if (!CadForm) {
      //window.location.href = "SA/login.html"; 
    }
  }
}

if (CadForm) {
  //Formulario de Cadastro
  CadForm.addEventListener("submit", async (eventcad) => {
    //Registrar Pessoa
    eventcad.preventDefault();

    let dataForm = new FormData(CadForm);
    dataForm.append("add", 1);

    let dados = await fetch("cadastrar.php", {
      method: "POST",
      body: dataForm,
    });

    var CadResposta = await dados.json();

    //Logar Pessoa
    let dataForm1 = new FormData();
    dataForm1.append('add', 1);
    dataForm1.append('LogEmail', CadResposta['dados'].CadEmail);
    dataForm1.append('LogSenha', CadResposta['dados'].CadSenha);

    let dados1 = await fetch("login.php", {
      method: "POST",
      body: dataForm1,
    });

    var CadLogresp = await dados1.json();

    if (CadLogresp['logado']) {
      user = CadLogresp['dados'];
      alert("Cadastrado com sucesso!")
      location.href = '../index.php'
    };

    localStorage.setItem('logado', `${user.iduser}/${user.name}/${user.email}/${user.master}`);

    console.log('CAD+LOG = ' + CadLogresp);
    console.log("USER = " + user);

  });
}

if (LogForm) {
  //Formulario de Login
  LogForm.addEventListener("submit", async (eventlog) => {
    eventlog.preventDefault();

    let dataForm = new FormData(LogForm);
    dataForm.append("add", 1);

    let dados = await fetch("login.php", {
      method: "POST",
      body: dataForm,
    });

    var LogResposta = await dados.json();

    if (LogResposta['logado']) {
      user = LogResposta['dados'];
      alert("Logado com sucesso!")
      location.href = '../index.php'
    }

    localStorage.setItem('logado', `${user.iduser}/${user.name}/${user.email}/${user.master}`);
    //console.log(LogResposta);  responde: logado,msg,master
    console.log(user);

  });
}

if (FBForm) {
  //Formulario de feedback
  FBForm.addEventListener("submit", async (eventfb) => {
    eventfb.preventDefault();

    
    let dataForm = new FormData(FBForm);
    dataForm.append("add", 1);
    dataForm.append("iduser", user.iduser);
    dataForm.append("idproduct", prodid);
    
    // document.getElementById("scoreFB").value
    
    let dados = await fetch("feedback.php", {
        method: "POST",
        body: dataForm,
    });

    var FBResposta = await dados.json();

    if(!FBResposta){
      alert("Feedback recebido com sucesso");
      location.href = "index.html";
    }

    console.log(FBResposta);
    

  })
};

function verificar(){
  if(!user.master){
    window.location.href = "index.html";
  }
};