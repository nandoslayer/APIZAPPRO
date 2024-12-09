<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envio de Mensagem</title>
    <style>
        /* Estilização da página */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        .container {
            background: #ffffff;
            color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group textarea {
            resize: none;
            height: 100px;
        }

        .button {
            background: #2193b0;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .button:hover {
            background: #176d8c;
        }

        .response {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
        }

        .success {
            background: #d4edda;
            color: #155724;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <script>
        // Variáveis de configuração globais
        const instanceName = "xxxxxxxxxee1f64d813d7c20af5f2xxx"; // Nome da instância da API
        const email = "nandoxxxxxx@gmail.com"; // E-mail do usuário
    </script>

    <div class="container">
        <h1>Envio de Mensagem de Teste</h1>
        <!-- Campo para inserir o número de WhatsApp -->
        <div class="form-group">
            <label for="phoneNumber">Número de WhatsApp:</label>
            <input type="text" id="phoneNumber" placeholder="Ex.: 5522888889999">
        </div>
        <!-- Campo para inserir a mensagem -->
        <div class="form-group">
            <label for="message">Mensagem:</label>
            <textarea id="message" placeholder="Digite sua mensagem aqui..."></textarea>
        </div>
        <!-- Botão para enviar a mensagem -->
        <button class="button" onclick="sendMessage()">Enviar Mensagem</button>
        <!-- Exibição da resposta da API -->
        <div id="response" class="response" style="display: none;"></div>
    </div>

    <script>
        /**
         * Função para enviar a mensagem via API.
         * - Valida os campos de número e mensagem.
         * - Faz a chamada para o endpoint da API usando Fetch.
         */
        function sendMessage() {
            const phoneNumber = document.getElementById('phoneNumber').value.trim(); // Captura o número
            const message = document.getElementById('message').value.trim(); // Captura a mensagem

            // Validações dos campos
            if (!phoneNumber) {
                showResponse('Por favor, insira um número de WhatsApp válido.', 'error');
                return;
            }
            if (!message) {
                showResponse('Por favor, insira uma mensagem.', 'error');
                return;
            }

            // Estrutura dos dados a serem enviados para a API
            const data = {
                number: phoneNumber,
                textMessage: {
                    text: message
                },
                options: {
                    delay: Math.floor(Math.random() * (3000 - 1000 + 1)) + 1000, // Delay aleatório
                    presence: 'composing'
                },
                instanceName: instanceName,
                email: email
            };

            const url = 'https://zappro.gestorssh.com.br/textsend.php'; // URL do endpoint da API

            // Envia os dados usando Fetch
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json()) // Converte a resposta para JSON
            .then(jsonResponse => {
                // Verifica o status retornado
                if (jsonResponse.status === "PENDING") {
                    showResponse('Mensagem enviada com sucesso!', 'success');
                } else {
                    showResponse('Erro ao enviar a mensagem: ' + (jsonResponse.error || 'Desconhecido'), 'error');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                showResponse('Erro ao enviar a mensagem.', 'error');
            });
        }

        /**
         * Exibe a resposta da API na interface.
         * @param {string} message - Mensagem a ser exibida.
         * @param {string} type - Tipo da mensagem ('success' ou 'error').
         */
        function showResponse(message, type) {
            const responseDiv = document.getElementById('response');
            responseDiv.textContent = message;
            responseDiv.className = `response ${type}`;
            responseDiv.style.display = 'block';
        }
    </script>
</body>
</html>
