<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Inter', sans-serif; line-height: 1.6; color: #1a1a1a; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; padding: 30px; border: 1px solid #e4e4e7; border-radius: 20px; background-color: #ffffff; }
        .header { margin-bottom: 30px; border-bottom: 1px solid #e4e4e7; padding-bottom: 20px; }
        .header h1 { font-size: 24px; font-weight: 700; color: #09090b; margin: 0; }
        .content { margin-bottom: 30px; }
        .field { margin-bottom: 20px; }
        .label { font-size: 12px; font-weight: 700; text-transform: uppercase; color: #71717a; letter-spacing: 0.1em; display: block; margin-bottom: 5px; }
        .value { font-size: 16px; color: #09090b; }
        .footer { font-size: 12px; color: #a1a1aa; text-align: center; margin-top: 40px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Inquiry</h1>
        </div>
        <div class="content">
            <div class="field">
                <span class="label">From</span>
                <span class="value">{{ $inquiry->name }} ({{ $inquiry->email }})</span>
            </div>
            <div class="field">
                <span class="label">Message</span>
                <div class="value" style="white-space: pre-wrap;">{{ $inquiry->message }}</div>
            </div>
        </div>
        <div class="footer">
            Sent from your Portfolio Website
        </div>
    </div>
</body>
</html>
