<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mesajınıza Yanıt</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            margin-bottom: 20px;
            border-bottom: 3px solid #343a40;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #343a40;
        }
        .content {
            padding: 20px 0;
        }
        .original-message {
            background-color: #f8f9fa;
            padding: 15px;
            margin-top: 30px;
            border-left: 3px solid #6c757d;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e9ecef;
            font-size: 12px;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Avukat Sitesi</div>
    </div>
    
    <div class="content">
        <p>Sayın {{ $contactMessage->name }},</p>
        
        <p>İletişim formumuz aracılığıyla gönderdiğiniz mesaj için teşekkür ederiz.</p>
        
        <div>
            {!! nl2br(e($replyMessage)) !!}
        </div>
        
        <div class="original-message">
            <p><strong>Gönderdiğiniz Mesaj:</strong></p>
            <p><strong>Konu:</strong> {{ $contactMessage->subject }}</p>
            <p><strong>Tarih:</strong> {{ $contactMessage->created_at->format('d.m.Y H:i') }}</p>
            <p><strong>Mesaj:</strong></p>
            <p>{!! nl2br(e($contactMessage->message)) !!}</p>
        </div>
    </div>
    
    <div class="footer">
        <p>Bu e-posta, iletişim formumuz aracılığıyla gönderdiğiniz mesaja yanıt olarak gönderilmiştir.</p>
        <p>© {{ date('Y') }} Avukat Sitesi. Tüm hakları saklıdır.</p>
    </div>
</body>
</html> 