<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesión Expirada — The Grup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto';
        }
        .error-container {
            background: white;
            border-radius: 1.5rem;
            padding: 3rem;
            text-align: center;
            max-width: 500px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }
        .error-code {
            font-size: 5rem;
            font-weight: 800;
            background: linear-gradient(120deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }
        .error-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 1rem;
        }
        .error-message {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }
        .error-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        .btn {
            padding: 0.875rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        .btn-primary {
            background: linear-gradient(120deg, #667eea, #764ba2);
            color: white;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
            color: white;
            text-decoration: none;
        }
        .btn-outline {
            background: transparent;
            border: 2px solid #e2e8f0;
            color: #0f172a;
        }
        .btn-outline:hover {
            border-color: #667eea;
            color: #667eea;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">419</div>
        <div class="error-title">Sesión Expirada</div>
        <div class="error-message">
            Tu sesión ha expirado o el token de seguridad es inválido. 
            <br>Por favor, vuelve a iniciar sesión.
        </div>
        <div class="error-actions">
            <a href="/" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i>
                Volver al Inicio
            </a>
            <a href="/login" class="btn btn-outline">
                <i class="bi bi-box-arrow-in-right"></i>
                Iniciar Sesión
            </a>
        </div>
    </div>
</body>
</html>
