document.addEventListener('DOMContentLoaded', function () {

    var telefone = document.getElementById('telefone');
    var cep = document.getElementById('cep');
    var cpf = document.getElementById('cpf');
    var rg = document.getElementById('rg');


    telefone.addEventListener('input', function () {
        this.value = this.value
            .replace(/\D/g, '')       
            .replace(/^(\d{2})(\d)/, '($1) $2')
            .replace(/(\d{5})(\d)/, '$1-$2') 
            .replace(/(-\d{4})\d+?$/, '$1'); 
    });

    cep.addEventListener('input', function () {
        this.value = this.value
            .replace(/\D/g, '')         
            .replace(/^(\d{5})(\d)/, '$1-$2')
            .replace(/(-\d{3})\d+?$/, '$1');
    });


    cpf.addEventListener('input', function () {
        this.value = this.value
            .replace(/\D/g, '')         
            .replace(/^(\d{3})(\d)/, '$1.$2') 
            .replace(/^(\d{3}\.\d{3})(\d)/, '$1.$2') 
            .replace(/^(\d{3}\.\d{3}\.\d{3})(\d)/, '$1-$2')
            .replace(/(-\d{2})\d+?$/, '$1'); 
    });


    rg.addEventListener('input', function () {
        this.value = this.value
            .replace(/\D/g, '')          
            .replace(/^(\d{2})(\d{2})/, '$1.$2') 
            .replace(/^(\d{2}\.\d{3})(\d{2})/, '$1.$2') 
            .replace(/^(\d{2}\.\d{3}\.\d{3})(\d{1,2})/, '$1-$2') 
            .slice(0, 12);            
    });


    const consultarCepButton = document.getElementById('consultarCep');
    const cepInput = document.getElementById('cep');

    if (consultarCepButton && cepInput) {
        consultarCepButton.addEventListener('click', function () {
            const cep = cepInput.value.replace(/\D/g, '');


            if (cep.length === 8) {

                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.erro) {
                            alert('CEP não encontrado.');
                            return;
                        }


                        document.getElementById('endereco').value = data.logradouro || '';
                        document.getElementById('bairro').value = data.bairro || '';
                        document.getElementById('cidade').value = data.localidade || '';
                        document.getElementById('estado').value = data.uf || '';
                    })
                    .catch(error => {
                        console.error('Erro ao consultar o CEP:', error);
                        alert('Erro ao consultar o CEP.');
                    });
            } else {
                alert('Por favor, insira um CEP válido com 8 dígitos.');
            }
        });
    }
});
