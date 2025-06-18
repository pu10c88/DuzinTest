# 🚀 Mestre dos Bots - Landing Page

Uma landing page completa e responsiva para captura de leads, construída com Hugo Static Site Generator.

![GitHub repo size](https://img.shields.io/github/repo-size/pu10c88/DuzinTest)
![GitHub last commit](https://img.shields.io/github/last-commit/pu10c88/DuzinTest)
![GitHub](https://img.shields.io/github/license/pu10c88/DuzinTest)

## ✨ Funcionalidades

### 🎯 **Landing Page Completa**
- Design moderno e profissional
- Estrutura otimizada para conversão
- Copywriting persuasivo
- Call-to-actions estratégicos

### 📱 **Totalmente Responsiva**
- Mobile-first design
- Funciona perfeitamente em todos os dispositivos
- Testes realizados em desktop, tablet e celular

### 🖼️ **Carousel de Fotos**
- Exibe resultados reais dos alunos
- Scroll automático e suave
- Pause ao passar o mouse
- Loop infinito

### 📝 **Sistema de Captura de Leads**
- Formulário com validação em tempo real
- Máscara automática para telefone brasileiro
- Sistema PHP para armazenamento
- Backup em LocalStorage
- Exportação para CSV
- Popup modal funcional

### 🎥 **Vídeo Integrado**
- Player HTML5 local
- Vídeo responsivo
- Controles nativos

### 🎨 **Características Visuais**
- Título com imagem personalizada
- Gradientes e animações suaves
- Tipografia profissional
- Esquema de cores atrativo

## 🛠️ Tecnologias Utilizadas

- **Hugo** - Static Site Generator
- **HTML5** - Estrutura semântica
- **CSS3** - Estilização avançada com Flexbox/Grid
- **JavaScript** - Interatividade e validações
- **PHP** - Backend para captura de leads

## 📦 Estrutura do Projeto

```
metrodosbotsreplica/
├── layouts/
│   └── index.html          # Template principal
├── static/
│   ├── api/
│   │   ├── leads.php       # Endpoint para leads
│   │   └── README.md       # Documentação da API
│   ├── carousel/           # Fotos do carousel
│   ├── cyberloop.mp4      # Vídeo local
│   └── thanks.html        # Página de agradecimento
├── public/                 # Arquivos gerados pelo Hugo
├── hugo.toml              # Configuração do Hugo
└── README.md              # Este arquivo
```

## 🚀 Como Usar

### Pré-requisitos
- [Hugo](https://gohugo.io/installation/) instalado
- Servidor web com PHP (para produção)

### Desenvolvimento Local

1. **Clone o repositório:**
```bash
git clone https://github.com/pu10c88/DuzinTest.git
cd DuzinTest
```

2. **Inicie o servidor Hugo:**
```bash
hugo server -D
```

3. **Acesse no navegador:**
```
http://localhost:1313
```

### Deploy para Produção

1. **Gere os arquivos estáticos:**
```bash
hugo --minify
```

2. **Faça upload da pasta `public/` para seu servidor**

3. **Configure o PHP no servidor para o sistema de leads**

## 📊 Sistema de Leads

### Recursos do Sistema
- ✅ Captura nome, email e telefone
- ✅ Validação completa dos campos
- ✅ Armazenamento em JSON
- ✅ Backup automático no navegador
- ✅ Exportação CSV
- ✅ Notificações por email (configurável)

### Configuração
Edite o arquivo `static/api/leads.php`:

```php
// Configure seu email
$to = 'seu-email@exemplo.com';

// Configure seu domínio
$headers .= "From: noreply@seudominio.com" . "\r\n";
```

### Acessar Leads Capturados

1. **Via arquivo JSON:** `/api/leads.json`
2. **Via exportação CSV:** `/api/leads.php?export=csv`
3. **Via console do navegador:** `downloadLeads()`

## 🎨 Customização

### Alterar Cores
Edite as variáveis CSS no arquivo `layouts/index.html`:

```css
:root {
    --primary-color: #f1c40f;
    --background-dark: #1a1a1a;
    --text-light: #fff;
}
```

### Substituir Fotos
Adicione suas fotos na pasta `static/carousel/` e atualize as referências no HTML.

### Modificar Conteúdo
Todo o conteúdo pode ser editado diretamente no arquivo `layouts/index.html`.

## 📱 Responsividade

A landing page foi testada e otimizada para:

- **Desktop:** 1920px+
- **Laptop:** 1024px - 1919px  
- **Tablet:** 768px - 1023px
- **Mobile:** 320px - 767px

## 🔧 Funcionalidades Técnicas

### JavaScript Implementado
- Validação de formulários em tempo real
- Máscara de telefone brasileiro
- Popup modal funcional
- Carousel automático
- Sistema de fallback para leads

### PHP Backend
- Sanitização de dados
- Validação server-side
- CORS configurado
- Rate limiting preparado
- Sistema de notificações

## 📈 Otimizações

- ⚡ **Performance:** Arquivos minificados
- 🔍 **SEO:** Meta tags otimizadas  
- 📱 **Mobile:** Touch-friendly design
- 🎯 **Conversão:** CTAs estratégicos
- 🚀 **Velocidade:** Static site generation

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 👤 Autor

**Paulo Loureiro**
- GitHub: [@pu10c88](https://github.com/pu10c88)

## 🤝 Contribuições

Contribuições são bem-vindas! Sinta-se à vontade para:

1. Fazer fork do projeto
2. Criar uma branch para sua feature
3. Fazer commit das mudanças
4. Fazer push para a branch
5. Abrir um Pull Request

## 📞 Suporte

Se encontrar algum problema ou tiver dúvidas:

1. Abra uma [issue](https://github.com/pu10c88/DuzinTest/issues)
2. Consulte a [documentação da API](static/api/README.md)
3. Verifique os logs do navegador (F12)

---

⭐ **Se este projeto foi útil, considere deixar uma estrela!** 