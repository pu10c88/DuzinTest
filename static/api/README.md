# Sistema de Captura de Leads - Mestre dos Bots

## 🎯 Funcionalidades Implementadas

### ✅ **Formulários Completos**
- **Nome** (obrigatório)
- **Email** (obrigatório, com validação)
- **Telefone/WhatsApp** (obrigatório, com máscara brasileira)
- **Origem** (heroForm ou popupForm)

### ✅ **Validação em Tempo Real**
- Validação de email com regex
- Validação de telefone brasileiro
- Feedback visual (verde/vermelho)
- Máscara automática para telefone

### ✅ **Carousel de Imagens**
- 4 slides com resultados de alunos
- Navegação por botões e indicadores
- Auto-play a cada 5 segundos
- Responsivo para mobile

### ✅ **Vídeo Local**
- Vídeo `cyberloop.mp4` integrado
- Player HTML5 nativo
- Responsivo

## 🔧 **Sistema de Leads**

### Captura de Dados
Cada lead capturado inclui:
```json
{
  "name": "Nome do usuário",
  "email": "email@exemplo.com",
  "phone": "(11) 99999-9999",
  "source": "heroForm ou popupForm",
  "timestamp": "2024-01-01T10:00:00Z",
  "page_url": "https://seusite.com/",
  "ip_address": "192.168.1.1",
  "user_agent": "Mozilla/5.0..."
}
```

### Opções de Armazenamento

#### 1. **Arquivo PHP (Atual)**
- Arquivo: `leads.php`
- Salva em: `leads.json`
- Funciona em qualquer servidor PHP

#### 2. **Local Storage (Backup)**
- Salva no navegador como fallback
- Função `downloadLeads()` para exportar
- Acesse pelo console: `downloadLeads()`

#### 3. **Integrações Possíveis**
- **Zapier**: Webhook para automatizar
- **Mailchimp**: API para email marketing
- **HubSpot**: CRM completo
- **Google Sheets**: Via Google Apps Script

## 📊 **Como Acessar os Leads**

### Método 1: Arquivo JSON
```bash
# Acesse diretamente o arquivo no servidor
/static/api/leads.json
```

### Método 2: Exportar CSV
```bash
# Acesse esta URL para baixar CSV
https://seusite.com/api/leads.php?export=csv
```

### Método 3: Console do Navegador
```javascript
// Digite no console do navegador
downloadLeads(); // Baixa JSON dos leads salvos localmente
```

### Método 4: Local Storage
```javascript
// Visualizar leads salvos localmente
console.log(JSON.parse(localStorage.getItem('leads')));
```

## 🚀 **Configuração para Produção**

### 1. **Configurar Email**
Edite `leads.php` linha 75:
```php
$to = 'seu-email@exemplo.com'; // SUBSTITUA COM SEU EMAIL
```

### 2. **Configurar Domínio**
Edite `leads.php` linha 95:
```php
$headers .= "From: noreply@seudominio.com" . "\r\n";
```

### 3. **Ativar Notificações**
Descomente linha 98 em `leads.php`:
```php
mail($to, $subject, $message, $headers);
```

### 4. **Configurar CORS**
Para outros domínios, edite linha 3:
```php
header("Access-Control-Allow-Origin: https://seudominio.com");
```

## 🔗 **Integrações Populares**

### Zapier Webhook
```javascript
// Substitua no JavaScript (layouts/index.html)
fetch('https://hooks.zapier.com/hooks/catch/YOUR_HOOK_ID/', {
    method: 'POST',
    body: JSON.stringify(leadData)
});
```

### Mailchimp API
```javascript
// Exemplo de integração
fetch('https://us1.api.mailchimp.com/3.0/lists/YOUR_LIST_ID/members', {
    method: 'POST',
    headers: {
        'Authorization': 'apikey YOUR_API_KEY',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        email_address: email,
        status: 'subscribed',
        merge_fields: {
            FNAME: name,
            PHONE: phone
        }
    })
});
```

### Google Sheets
```javascript
// Via Google Apps Script
fetch('https://script.google.com/macros/s/YOUR_SCRIPT_ID/exec', {
    method: 'POST',
    body: JSON.stringify(leadData)
});
```

## 📈 **Monitoramento**

### Verificar Leads
```bash
# Visualizar leads capturados
tail -f /path/to/leads.json
```

### Estatísticas
```javascript
// No console do navegador
const leads = JSON.parse(localStorage.getItem('leads') || '[]');
console.log(`Total de leads: ${leads.length}`);
console.log(`Leads heroForm: ${leads.filter(l => l.source === 'heroForm').length}`);
console.log(`Leads popupForm: ${leads.filter(l => l.source === 'popupForm').length}`);
```

## 🛡️ **Segurança**

### Proteções Implementadas
- Sanitização de dados com `filter_var()`
- Validação de email server-side
- Validação de método HTTP
- CORS configurado
- Rate limiting recomendado

### Proteções Adicionais
```php
// Adicionar rate limiting
session_start();
$max_requests = 5;
$time_window = 3600; // 1 hora

if (!isset($_SESSION['requests'])) {
    $_SESSION['requests'] = [];
}

$current_time = time();
$_SESSION['requests'][] = $current_time;

if (count($_SESSION['requests']) >= $max_requests) {
    http_response_code(429);
    echo json_encode(['error' => 'Muitas requisições']);
    exit();
}
```

## 📞 **Suporte**

### Testando o Sistema
1. Preencha o formulário da página
2. Verifique o console do navegador
3. Verifique o arquivo `leads.json`
4. Teste a exportação CSV

### Problemas Comuns
- **Erro 500**: Verifique permissões do arquivo `leads.json`
- **CORS**: Configure domínios permitidos
- **Email não funciona**: Configure servidor SMTP
- **Dados não salvam**: Verifique permissões de escrita

---

**Sistema desenvolvido para Mestre dos Bots**
**Captura leads com eficiência e segurança** 