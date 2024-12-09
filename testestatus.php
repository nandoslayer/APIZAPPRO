<?php 
// Define o domínio do servidor
$dominioserver = "zappro.gestorssh.com.br";

// Define o token atual da API
$currentApiToken = "xxxxxxxxxee1f64d813d7c20af5f2xxx";

// Define o email atual do usuário
$currentEmail = "nandoxxxxxx@gmail.com";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status WhatsApp</title>
    <style>
        /* Estilo para o corpo da página */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe); /* Gradiente de fundo */
            color: #333; /* Cor do texto */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; /* Centraliza horizontalmente */
            align-items: center; /* Centraliza verticalmente */
            height: 100vh; /* Altura da viewport */
        }

        /* Container do status */
        .status-container {
            text-align: center;
            padding: 20px;
            border-radius: 10px; /* Bordas arredondadas */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Sombra */
            background: #fff; /* Fundo branco */
            max-width: 400px; /* Largura máxima */
            width: 100%; /* Largura completa */
        }

        /* Texto de status */
        .status-container .status-text {
            font-size: 24px; /* Tamanho da fonte */
            font-weight: bold; /* Negrito */
            margin-bottom: 20px; /* Espaçamento inferior */
            padding: 10px; /* Espaçamento interno */
            border-radius: 5px; /* Bordas arredondadas */
            transition: all 0.3s ease-in-out; /* Transição suave */
        }

        /* Cores para diferentes estados */
        .status-container .status-primary {
            color: #0056b3;
            background: #cce5ff;
        }

        .status-container .status-success {
            color: #155724;
            background: #d4edda;
        }

        .status-container .status-danger {
            color: #721c24;
            background: #f8d7da;
        }

        /* Botão de atualização */
        .refresh-button {
            margin-top: 20px; /* Espaçamento superior */
            padding: 10px 20px; /* Espaçamento interno */
            border: none; /* Sem borda */
            border-radius: 5px; /* Bordas arredondadas */
            background: #4caf50; /* Cor de fundo */
            color: #fff; /* Cor do texto */
            font-size: 16px; /* Tamanho da fonte */
            cursor: pointer; /* Cursor pointer */
            transition: background 0.3s ease; /* Transição suave */
        }

        /* Efeito de hover no botão */
        .refresh-button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>

<!-- Container principal para exibir o status -->
<div class="status-container" id="status-container">
    <!-- Texto de status inicial -->
    <div class="status-text status-primary" id="statuswhats">Carregando...</div>
    <!-- Botão para atualizar o status manualmente -->
    <button class="refresh-button" onclick="checkStatus()">Atualizar Status</button>
</div>

<script>
    // Função para verificar o status do WhatsApp
    function checkStatus() {
        // URL da API para verificar o status da sessão
        const url = 'https://<?php echo $dominioserver; ?>/statussession.php';

        // Dados a serem enviados na requisição
        const postData = {
            instanceName: '<?php echo $currentApiToken; ?>',
            email: '<?php echo $currentEmail; ?>'
        };

        // Configuração da requisição fetch
        const options = {
            method: 'POST', // Método HTTP
            headers: {
                'Content-Type': 'application/json' // Cabeçalho indicando JSON
            },
            body: JSON.stringify(postData) // Dados enviados como string JSON
        };

        // Faz a requisição para o servidor
        fetch(url, options)
            .then(response => {
                // Verifica se a resposta é válida
                if (!response.ok) {
                    throw new Error(`Erro na resposta da rede: ${response.statusText}`);
                }
                return response.json(); // Converte a resposta em JSON
            })
            .then(data => {
                // Atualiza os elementos HTML com base na resposta
                const statusContainer = document.getElementById('status-container');
                const statusText = document.getElementById('statuswhats');

                if (!statusContainer || !statusText) {
                    console.error("Elementos de status não encontrados.");
                    return;
                }

                // Verifica o estado retornado pela API
                if (data.instance && data.instance.state === 'open') {
                    statusText.innerHTML = 'WhatsApp Conectado';
                    statusText.className = 'status-text status-success'; // Aplica estilo de sucesso
                } else {
                    statusText.innerHTML = 'WhatsApp Desconectado';
                    statusText.className = 'status-text status-danger'; // Aplica estilo de erro
                }
            })
            .catch(error => {
                // Trata erros de requisição
                console.error('Erro na requisição:', error);
                const statusText = document.getElementById('statuswhats');

                if (statusText) {
                    statusText.innerHTML = 'Erro ao obter status do WhatsApp';
                    statusText.className = 'status-text status-danger'; // Aplica estilo de erro
                }
            });
    }

    // Chama a função automaticamente ao carregar a página
    document.addEventListener('DOMContentLoaded', checkStatus);
</script>

</body>
</html>
