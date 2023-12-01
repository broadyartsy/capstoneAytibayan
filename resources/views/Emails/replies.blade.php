<!DOCTYPE html>
<html>
<head>
<title>Reply to your email</title>
</head>
<body>

<p>Dear {{ $recipientName }},</p>

<h4>Subject:</h4>
<p>This message is brought to you by your {{ $subject }}.</p>

<h4>Body:</h4>
<p>{{ $body }}</p>

<p>Sincerely,</p>
<p>{{ $senderName }}</p>

</body>
</html>
