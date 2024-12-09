# 📄 **Documentação da API - ZAPPRO**

---

## 🚀 **Objetivo**

A API ZAPPRO oferece ferramentas para:  
1️⃣ Verificar o **status de conexão do WhatsApp**.  
2️⃣ Enviar mensagens automáticas para números no WhatsApp.  

---

## **1️⃣ Verificar Status da Sessão**  

### 🌐 **URL da API**  
```
https://zappro.gestorssh.com.br/statussession.php
```

### 🛠️ **Método**  
`POST`

### 📤 **Payload Enviado**

| Campo            | Tipo     | Descrição                                      |
|-------------------|----------|----------------------------------------------|
| `instanceName`    | `string` | Token único para identificar a sessão.        |
| `email`           | `string` | E-mail associado ao token para autenticação.  |

#### 📝 **Exemplo de Payload**

```json
{
  "instanceName": "xxxxxxxxxee1f64d813d7c20af5f2xxx",
  "email": "usuario@gmail.com"
}
```

### 🔄 **Resposta da API**

| Campo      | Tipo     | Descrição                          |
|------------|----------|------------------------------------|
| `state`    | `string` | Status da conexão (`open` ou `closed`). |

#### 🟢 **Exemplo - Conexão Ativa**  
```json
{
  "instance": {
    "state": "open"
  }
}
```

#### 🔴 **Exemplo - Conexão Inativa**  
```json
{
  "instance": {
    "state": "closed"
  }
}
```

---

## **2️⃣ Enviar Mensagens**

### 🌐 **URL da API**  
```
https://zappro.gestorssh.com.br/textsend.php
```

### 🛠️ **Método**  
`POST`

### 📤 **Payload Enviado**

| Campo              | Tipo       | Descrição                                                                                  |
|---------------------|------------|------------------------------------------------------------------------------------------|
| `number`           | `string`   | 📱 Número do WhatsApp (formato internacional, ex.: `5522888889999`).                       |
| `textMessage.text` | `string`   | ✍️ Texto da mensagem a ser enviada.                                                       |
| `options.delay`    | `integer`  | ⏳ Tempo de atraso (em milissegundos) para o envio.                                        |
| `options.presence` | `string`   | 💬 Status de presença antes do envio (`composing` ou outros valores permitidos).           |
| `instanceName`     | `string`   | 🏷️ Token único da instância configurada.                                                  |
| `email`            | `string`   | 📧 E-mail do usuário para autenticação.                                                   |

#### 📝 **Exemplo de Payload**

```json
{
  "number": "5522888889999",
  "textMessage": {
    "text": "Olá! Esta é uma mensagem de teste."
  },
  "options": {
    "delay": 1500,
    "presence": "composing"
  },
  "instanceName": "xxxxxxxxxee1f64d813d7c20af5f2xxx",
  "email": "usuario@gmail.com"
}
```

### 🔄 **Resposta da API**

| Campo    | Tipo      | Descrição                                      |
|----------|-----------|-----------------------------------------------|
| `status` | `string`  | ✅ Status do envio (`PENDING` indica sucesso). |
| `error`  | `string`  | ❌ Mensagem de erro, caso ocorra.              |

#### ✅ **Exemplo de Resposta - Sucesso**  

```json
{
  "status": "PENDING"
}
```

#### ❌ **Exemplo de Resposta - Erro**

```json
{
  "status": "FAILED",
  "error": "Número inválido"
}
```

---

## 🔍 **Observações Gerais**

- **Formato Internacional**: Sempre use números no formato `55 + código DDD + número`.  
- **Simulação de Digitação**: O campo `delay` simula um atraso antes do envio.  
- **Status de Presença**: Use `composing` para simular que o remetente está "escrevendo".  

---

## 🌟 **Pronto para usar!**

1️⃣ Configure os parâmetros corretamente.  
2️⃣ Teste as APIs para monitorar conexões e enviar mensagens com eficiência. 🚀
