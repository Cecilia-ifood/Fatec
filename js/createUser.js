document.getElementById('submitButton').addEventListener('click', createUser);

function createUser() {
    const nomeuser = document.getElementById('nomeuser').value;
    const emailuser = document.getElementById('emailuser').value;
    const senhauser = document.getElementById('senhauser').value;
    const datanascimentouser = document.getElementById('datanascimentouser').value;
    if (!nomeuser) {
        alert("Por favor, insira um nome!");
        return;
    }
    let agora = new Date();
    let dataFormatada = agora.toISOString().replace('T', ' ').substring(0, 19);
    const usuario = {
        nome: nomeuser,
        email: emailuser,
        senha: senhauser,
        criado: dataFormatada,
        datanascimento: datanascimentouser
    };
    fetch('/backend/usuarios.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(usuario)
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 401) {
                throw new Error('Não autorizado');
            } else {
                throw new Error('Sem rede ou não conseguiu localizar o recurso');
            }
        }
        return response.json();
    })
    .then(data => {
        if(!data.status){
            Swal.fire('Usuario já existe!')
        }else{
            Swal.fire('Usuario criado!')
        } 
       
    })
    .catch(error => alert('Erro na requisição: ' + error));
}
