const { readFileSync, writeFileSync, existsSync } = require('fs');
const path = require('path');

exports.handler = async (event, context) => {
  // Configurar CORS
  const headers = {
    'Access-Control-Allow-Origin': '*',
    'Access-Control-Allow-Headers': 'Content-Type',
    'Access-Control-Allow-Methods': 'GET, POST, OPTIONS'
  };

  // Responder a requisições OPTIONS (preflight)
  if (event.httpMethod === 'OPTIONS') {
    return {
      statusCode: 200,
      headers,
      body: ''
    };
  }

  // Apenas aceitar POST para submissão de leads
  if (event.httpMethod !== 'POST') {
    return {
      statusCode: 405,
      headers,
      body: JSON.stringify({ error: 'Método não permitido' })
    };
  }

  try {
    // Parse do corpo da requisição
    const data = JSON.parse(event.body);
    
    // Validação básica
    if (!data.name || !data.email || !data.phone) {
      return {
        statusCode: 400,
        headers,
        body: JSON.stringify({ 
          success: false, 
          message: 'Todos os campos são obrigatórios' 
        })
      };
    }

    // Validação de email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(data.email)) {
      return {
        statusCode: 400,
        headers,
        body: JSON.stringify({ 
          success: false, 
          message: 'Email inválido' 
        })
      };
    }

    // Sanitização dos dados
    const leadData = {
      name: data.name.trim(),
      email: data.email.trim().toLowerCase(),
      phone: data.phone.trim(),
      timestamp: new Date().toISOString(),
      source: data.source || 'website',
      ip: event.headers['x-forwarded-for'] || event.headers['x-real-ip'] || 'unknown'
    };

    // Caminho do arquivo de leads (no contexto do Netlify)
    const leadsFile = '/tmp/leads.json';
    
    // Ler leads existentes ou criar array vazio
    let leads = [];
    if (existsSync(leadsFile)) {
      try {
        const fileContent = readFileSync(leadsFile, 'utf8');
        leads = JSON.parse(fileContent);
      } catch (error) {
        console.error('Erro ao ler arquivo de leads:', error);
        leads = [];
      }
    }

    // Verificar se o lead já existe (por email)
    const existingLead = leads.find(lead => lead.email === leadData.email);
    if (existingLead) {
      return {
        statusCode: 200,
        headers,
        body: JSON.stringify({ 
          success: true, 
          message: 'Lead já cadastrado anteriormente',
          duplicate: true
        })
      };
    }

    // Adicionar novo lead
    leads.push(leadData);

    // Salvar no arquivo
    try {
      writeFileSync(leadsFile, JSON.stringify(leads, null, 2));
    } catch (error) {
      console.error('Erro ao salvar lead:', error);
    }

    // Enviar notificação por email (opcional - usando Netlify Forms ou serviço externo)
    // Aqui você pode integrar com serviços como SendGrid, Mailgun, etc.
    
    console.log('Novo lead capturado:', leadData);

    return {
      statusCode: 200,
      headers,
      body: JSON.stringify({ 
        success: true, 
        message: 'Lead capturado com sucesso!',
        leadId: leads.length
      })
    };

  } catch (error) {
    console.error('Erro ao processar lead:', error);
    
    return {
      statusCode: 500,
      headers,
      body: JSON.stringify({ 
        success: false, 
        message: 'Erro interno do servidor' 
      })
    };
  }
}; 