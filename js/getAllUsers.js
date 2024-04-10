
function getAll() {
    fetch('/backend/usuarios.php', {
        method: 'GET'
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
        displayUsers(data);
    })
    .catch(error => alert('Erro na requisição: ' + error));
}

function displayUsers(data) {
    const usuarios = data.users;  
    const usersDiv = document.getElementById('proList');
    usersDiv.innerHTML = ''; 

    const list = document.createElement('ul');
    usuarios.forEach(user => {
        const listItem = document.createElement('li');
        listItem.textContent = `${user.id} - ${user.nome} - ${user.email} - ${user.senha} - ${user.criado} - ${user.datanascimento}`;
        list.appendChild(listItem);
    });

    usersDiv.appendChild(list);
}
getAll();