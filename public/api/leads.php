<?php
// Configuração de CORS para permitir requisições do frontend
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Responder a requisições OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Verificar se é uma requisição POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Método não permitido']);
    exit();
}

// Obter dados JSON da requisição
$input = json_decode(file_get_contents('php://input'), true);

// Validar dados obrigatórios
if (!isset($input['name']) || !isset($input['email']) || !isset($input['phone'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Dados obrigatórios faltando']);
    exit();
}

// Sanitizar dados
$lead = [
    'name' => filter_var($input['name'], FILTER_SANITIZE_STRING),
    'email' => filter_var($input['email'], FILTER_SANITIZE_EMAIL),
    'phone' => filter_var($input['phone'], FILTER_SANITIZE_STRING),
    'source' => filter_var($input['source'] ?? '', FILTER_SANITIZE_STRING),
    'timestamp' => $input['timestamp'] ?? date('c'),
    'page_url' => filter_var($input['page_url'] ?? '', FILTER_SANITIZE_URL),
    'ip_address' => $_SERVER['REMOTE_ADDR'],
    'user_agent' => $_SERVER['HTTP_USER_AGENT']
];

// Validar email
if (!filter_var($lead['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Email inválido']);
    exit();
}

// Arquivo para salvar os leads
$leads_file = 'leads.json';

// Carregar leads existentes
$leads = [];
if (file_exists($leads_file)) {
    $leads = json_decode(file_get_contents($leads_file), true) ?? [];
}

// Adicionar novo lead
$leads[] = $lead;

// Salvar leads no arquivo
if (file_put_contents($leads_file, json_encode($leads, JSON_PRETTY_PRINT))) {
    // Opcional: Enviar email de notificação
    sendNotificationEmail($lead);
    
    // Resposta de sucesso
    http_response_code(201);
    echo json_encode([
        'success' => true,
        'message' => 'Lead capturado com sucesso',
        'lead_id' => count($leads)
    ]);
} else {
    // Erro ao salvar
    http_response_code(500);
    echo json_encode(['error' => 'Erro interno do servidor']);
}

// Função para enviar email de notificação (opcional)
function sendNotificationEmail($lead) {
    $to = 'seu-email@exemplo.com'; // SUBSTITUA COM SEU EMAIL
    $subject = 'Novo Lead - Mestre dos Bots';
    
    $message = "
    <html>
    <head>
        <title>Novo Lead Capturado</title>
    </head>
    <body>
        <h2>Novo Lead Capturado!</h2>
        <p><strong>Nome:</strong> {$lead['name']}</p>
        <p><strong>Email:</strong> {$lead['email']}</p>
        <p><strong>Telefone:</strong> {$lead['phone']}</p>
        <p><strong>Origem:</strong> {$lead['source']}</p>
        <p><strong>Data:</strong> {$lead['timestamp']}</p>
        <p><strong>Página:</strong> {$lead['page_url']}</p>
        <p><strong>IP:</strong> {$lead['ip_address']}</p>
        
        <hr>
        <p>Este lead foi capturado através do site Mestre dos Bots.</p>
    </body>
    </html>
    ";
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: noreply@seusite.com" . "\r\n"; // SUBSTITUA COM SEU DOMÍNIO
    
    // Enviar email (descomente para ativar)
    // mail($to, $subject, $message, $headers);
}

// Função para exportar leads (acesse: /api/leads.php?export=csv)
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    $leads_file = 'leads.json';
    
    if (file_exists($leads_file)) {
        $leads = json_decode(file_get_contents($leads_file), true) ?? [];
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="leads-mestre-dos-bots.csv"');
        
        $output = fopen('php://output', 'w');
        
        // Cabeçalho CSV
        fputcsv($output, ['Nome', 'Email', 'Telefone', 'Origem', 'Data', 'Página', 'IP']);
        
        // Dados
        foreach ($leads as $lead) {
            fputcsv($output, [
                $lead['name'],
                $lead['email'],
                $lead['phone'],
                $lead['source'],
                $lead['timestamp'],
                $lead['page_url'],
                $lead['ip_address']
            ]);
        }
        
        fclose($output);
        exit();
    }
}
?> 