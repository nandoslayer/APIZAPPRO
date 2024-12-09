# 📄 **Documentação da API - ZAPPRO**

---

## 🚀 **Objetivo**

Esta API verifica o **status de conexão do WhatsApp** via integração com uma sessão externa. Ela é responsável por retornar o estado da sessão (`open` ou outro status) para aplicações que desejam monitorar essa conexão.

---

## 🛠️ **Detalhes da API**

### **URL da API**
```
https://zappro.gestorssh.com.br/statussession.php
```

---

## 📤 **Dados Enviados via POST**

A API recebe os seguintes dados no corpo da requisição JSON:

```json
{
  "instanceName": "nandoctslayeree1f64d813d7c20af5f2",
  "email": "nandoctslayer@gmail.com"
}
```

### Parâmetros:

- **`instanceName`**: Token único da sessão para autenticação.  
- **`email`**: E-mail associado à sessão/token.

---

## 🔄 **Resposta da API**

### **Formato**
A resposta será um JSON com a seguinte estrutura:

```json
{
  "instance": {
    "state": "open"
  }
}
```

---

### 🟢 **Caso Conectado:**

```json
{
  "instance": {
    "state": "open"
  }
}
```

> **Significado:** A sessão do WhatsApp está conectada.

---

### 🔴 **Caso Desconectado:**

```json
{
  "instance": {
    "state": "closed"
  }
}
```

> **Significado:** A sessão do WhatsApp está desconectada.

---

## 📊 **Cenários e Lógica**

1. **`state = "open"`:** Indica que o WhatsApp está ativo.  
2. **`state = "closed"`:** Indica desconexão da sessão.

---

## 🔗 **Exemplo de Uso**

Para verificar o status com `Fetch API` do frontend:

```javascript
fetch('https://zappro.gestorssh.com.br/statussession.php', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    instanceName: 'xxxxxxxxxee1f64d813d7c20af5f2xxx',
    email: 'nandoxxxxxx@gmail.com'
  })
})
.then(response => response.json())
.then(data => console.log(data));
```

---
